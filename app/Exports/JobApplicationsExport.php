<?php

namespace App\Exports;

use App\Models\JobApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JobApplicationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $jobId;
    protected $status;

    public function __construct($jobId = null, $status = null)
    {
        $this->jobId = $jobId;
        $this->status = $status;
    }

    public function collection()
    {
        $query = JobApplication::with(['job:id,title', 'reviewer:id,name'])
            ->orderBy('created_at', 'desc');

        if ($this->jobId) {
            $query->where('job_id', $this->jobId);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Job Title',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Years Experience',
            'Status',
            'LinkedIn',
            'Portfolio',
            'Reviewed By',
            'Applied At',
            'Reviewed At',
        ];
    }

    public function map($application): array
    {
        return [
            $application->id,
            $application->job->title ?? 'N/A',
            $application->first_name,
            $application->last_name,
            $application->email,
            $application->phone,
            $application->years_experience ?? 'N/A',
            ucfirst($application->status),
            $application->linkedin_url ?? 'N/A',
            $application->portfolio_url ?? 'N/A',
            $application->reviewer->name ?? 'N/A',
            $application->created_at->format('Y-m-d H:i:s'),
            $application->reviewed_at ? $application->reviewed_at->format('Y-m-d H:i:s') : 'N/A',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
