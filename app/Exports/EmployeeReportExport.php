<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeeReportExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct($employee, $employee_task,$startDate,$endDate)
    {
        $this->employee = $employee;
        $this->employee_task = $employee_task;
        $this->name = $employee->first_name . ' ' . $employee->last_name;
        $this->email = $employee->email;
        $this->id = $employee->id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $array = [];
        foreach ($this->employee_task as $value) {
            $company = DB::table('companies')->where('id', $value->company_id)->first();
            $totalMinutes = Carbon::parse($value->start_time)->diffInMinutes(Carbon::parse($value->end_time));
            $totalHoursFormatted = floor($totalMinutes / 60) . ':' . str_pad($totalMinutes % 60, 2, '0', STR_PAD_LEFT);
            $overtime_record = DB::table('employee_tasks')
                ->where('date',$value->date)
                ->where('employee_id', $this->id)
                ->whereBetween('date', [$this->startDate, $this->endDate])
                ->get();
            $pending = true;
            $total_hours = 0;
            $total_minutes = 0;
            foreach ($overtime_record as $task) {
                if($task->status == 'approved'){
                    $pending = false;
                    $start_time = \Carbon\Carbon::parse($task->start_time);
                    $end_time = \Carbon\Carbon::parse($task->end_time);

                    $total_hours_duration = $end_time->diff($start_time);
                    $total_hours += $total_hours_duration->h;
                    $total_minutes += $total_hours_duration->i;
                }
            }
            if ($pending){
                foreach ($overtime_record as $task) {
                    if($task->status == 'pending'){
                        $start_time = \Carbon\Carbon::parse($task->start_time);
                        $end_time = \Carbon\Carbon::parse($task->end_time);

                        $total_hours_duration = $end_time->diff($start_time);
                        $total_hours += $total_hours_duration->h;
                        $total_minutes += $total_hours_duration->i;
                    }
                }
            }
            $total_hours += intdiv($total_minutes, 60);
            $total_minutes = $total_minutes % 60;
            $total_time_formatted  = sprintf('%02d:%02d', $total_hours, $total_minutes);
            $overtime_minutes = max(0, ($total_hours * 60 + $total_minutes) - 480);
            $overtime_hours = intdiv($overtime_minutes, 60);
            $overtime_remainder_minutes = $overtime_minutes % 60;
            $overtime_time_formatted = sprintf('%02d:%02d', $overtime_hours, $overtime_remainder_minutes);
            $array[] = [
                'company_name' => $company->name,
                'name' => $this->name,
                'email' => $this->email,
                'project' => $value->project,
                'client' => $value->client,
                'description' => $value->description,
                'date' => Carbon::parse($value->date)->format('d-m-y'),
                'start_time' => Carbon::parse($value->start_time)->format('h:i A'),
                'end_time' => Carbon::parse($value->end_time)->format('h:i A'),
                'total_hours' => $totalHoursFormatted,
                'ot_hours' => $overtime_time_formatted == '00:00' ? '-' : $overtime_time_formatted,
                'location' => $value->location,
                'status' => $value->status,
                'reject_reason' => $value->reject_reason,
            ];
        }
        return collect($array);
    }

    public function headings(): array
    {
        return [
            'Company',
            'Name',
            'Email',
            'Project',
            'Client',
            'Description',
            'Date',
            'Start Time',
            'End Time',
            'Total Hours',
            'OT Hours',
            'Location',
            'Status',
            'Reject Reason',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row (headings) as bold
            1 => ['font' => ['bold' => true]],
        ];
    }
}
