@extends('layout')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #205ebe 0%, #4b5563 100%);
        --secondary-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --info-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        --bg-gradient: linear-gradient(180deg, #e2e8f0 0%, #f8fafc 100%);
    }

    .dashboard-wrapper {
        background: var(--bg-gradient);
        min-height: 100vh;
        padding: 3rem 0;
        position: relative;
        overflow: hidden;
    }

    .dashboard-header {
        background: var(--primary-gradient);
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        animation: fadeInDown 0.5s ease;
    }

    .branch-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
        border: none;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.5s ease;
    }

    .branch-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .branch-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .branch-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .branch-logo {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .branch-logo:hover {
        transform: scale(1.1);
    }

    .branch-stats {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .stat-card:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    ''

    .stat-card:hover .stat-label,
    .stat-card:hover .stat-value,
    .stat-card:hover .stat-icon {
        color: white !important;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .stat-icon.primary {
        background: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
    }

    .stat-icon.success {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .stat-icon.warning {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .stat-icon.danger {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .stat-icon.info {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 500;
    }

    .status-section {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e5e7eb;
    }

    .status-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .status-title i {
        color: #4f46e5;
        font-size: 1.75rem;
    }

    .status-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .status-item:hover {
        background: var(--secondary-gradient);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .status-item:hover .status-label,
    .status-item:hover .status-value,
    .status-item:hover .status-today {
        color: white;
    }

    .status-label {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 500;
    }

    .status-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.2;
    }

    .charts-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-top: 2rem;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 992px) {
        .branch-stats {
            grid-template-columns: repeat(3, 1fr);
        }

        .charts-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .branch-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-header {
            padding: 1.5rem;
        }
    }
</style>

@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid">
        <div class="dashboard-header">
            <h3 class="text-white">Hello Esteemgroup!</h3>
            <p class="lead">Gain insights into your business performance with real-time data.</p>
        </div>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    </div>

    <div class="container-fluid ecommerce-dashboard">
        <div class="row">
            @if(!empty($companies))
            @foreach ($companies as $list)
            @php
            $statusLabels = [];
            $statusCounts = [];
            $colors = ['#4f46e5', '#10b981', '#f59e0b', '#ef4444', '#3b82f6'];
            @endphp
            <div class="col-12 col-md-12 mt-2">
                <div class="branch-card">
                    <div class="branch-card-header">
                        <h3 class="branch-title">
                            <img src="{{ asset($list->logo) }}" alt="Branch" class="branch-logo">
                            {{ $list->name ?? '' }}
                        </h3>
                    </div>

                    <div class="branch-stats">
                        @role('admin')
                        <div class="stat-card">
                            <div class="stat-icon primary">
                                <i class="ri-user-line"></i>
                            </div>
                            <div class="stat-value">
                                <a href="{{ url('admin/users/company/'.$list->id) }}">{{ $list->users_count }}</a>
                            </div>
                            <div class="stat-label">
                                <a href="{{ url('admin/users/company/'.$list->id) }}">Total Users</a>
                            </div>
                        </div>
                        @endrole()
                        <div class="stat-card">
                            <div class="stat-icon info">
                                <i class="ri-file-list-line"></i>
                            </div>
                            <div class="stat-value">
                                <a href="{{ url('admin/leads/company/all/'.$list->id) }}">{{ $list->leads_count }}</a>
                            </div>
                            <div class="stat-label">
                                <a href="{{ url('admin/leads/company/all/'.$list->id) }}">Total Leads</a>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon success">
                                <i class="ri-file-list-line"></i>
                            </div>
                            <div class="stat-value">
                                <a href="{{ url('admin/leads/company/today/'.$list->id) }}">{{ $list->today_leads_count }}</a>
                            </div>
                            <div class="stat-label">
                                <a href="{{ url('admin/leads/company/today/'.$list->id) }}">Today's Leads</a>
                            </div>
                        </div>
                        <!-- <div class="stat-card">
                            <div class="stat-icon warning">
                                <i class="ri-time-line"></i>
                            </div>
                            <div class="stat-value">
                                <a href="{{ url('admin/leads/company/pending/'.$list->id) }}">{{ $list->pending_leads_count ?? 0 }}</a>
                            </div>
                            <div class="stat-label">
                                <a href="{{ url('admin/leads/company/pending/'.$list->id) }}">Pending Leads</a>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon danger">
                                <i class="ri-close-circle-line"></i>
                            </div>
                            <div class="stat-value">
                                <a href="{{ url('admin/leads/company/rejected/'.$list->id) }}">{{ $list->rejected_leads_count ?? 0 }}</a>
                            </div>
                            <div class="stat-label">
                                <a href="{{ url('admin/leads/company/rejected/'.$list->id) }}">Rejected Leads</a>
                            </div>
                        </div> -->
                    </div>

                    <div class="status-section">
                        <h4 class="status-title mb-3">
                            <i class="ri-bar-chart-line"></i> Lead Status Overview
                        </h4>
                        <div class="row g-3">
                            @if(!empty($list->status))
                            @foreach ($list->status as $status)
                            @php
                                if (auth()->user()->role == 'admin') {
        $leadcount = DB::table('lead_models')
            ->where('company_id', $list->id)
            ->where('status', $status->status)
            ->count();
    } else {
        $leadcount = DB::table('lead_models')
            ->join('assign_leads', 'assign_leads.lead_id', '=', 'lead_models.id')
            ->where('lead_models.company_id', $list->id)
            ->where('lead_models.status', $status->status)
            ->where('assign_leads.user_id', auth()->id()) // optional: only assigned to this user
            ->count();
    }



                            $statusLabels[] = $status->status;
                            $statusCounts[] = $leadcount;
                            @endphp
                            <div class="col-6 col-md-3">
                                <div class="status-item">
                                    <span class="status-label">{{ $status->status ?? '' }}</span>
                                    <span class="status-value">{{ $leadcount ?? 0 }}</span>
                                    <small class="status-today">
                                        <a href="{{ url('admin/leads/'.$list->id.'/'.$status->status) }}">View</a>
                                    </small>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    @if(!empty($statusLabels))
                    <div class="charts-container">
                        <div>
                            <canvas id="bar-chart-{{ $list->id }}" height="150"></canvas>
                        </div>
                        <div>
                            <canvas id="doughnut-chart-{{ $list->id }}" height="150"></canvas>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Bar Chart
                                const barCtx = document.getElementById('bar-chart-{{ $list->id }}').getContext('2d');
                                new Chart(barCtx, {
                                    type: 'bar',
                                    data: {
                                        labels: @json($statusLabels),
                                        datasets: [{
                                            label: 'Leads by Status',
                                            data: @json($statusCounts),
                                            backgroundColor: @json($colors),
                                            borderRadius: 8,
                                            borderWidth: 1,
                                            borderColor: '#ffffff'
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                display: false
                                            },
                                            title: {
                                                display: true,
                                                text: 'Lead Status Distribution',
                                                color: '#1e293b',
                                                font: {
                                                    size: 16,
                                                    weight: 'bold'
                                                }
                                            }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                ticks: {
                                                    stepSize: 1
                                                },
                                                grid: {
                                                    color: '#e5e7eb'
                                                }
                                            },
                                            x: {
                                                grid: {
                                                    display: false
                                                }
                                            }
                                        },
                                        animation: {
                                            duration: 1000,
                                            easing: 'easeOutQuart'
                                        }
                                    }
                                });

                                // Doughnut Chart
                                const doughnutCtx = document.getElementById('doughnut-chart-{{ $list->id }}').getContext('2d');
                                new Chart(doughnutCtx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: @json($statusLabels),
                                        datasets: [{
                                            data: @json($statusCounts),
                                            backgroundColor: @json($colors),
                                            borderWidth: 2,
                                            borderColor: '#ffffff'
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'bottom',
                                                labels: {
                                                    font: {
                                                        size: 12
                                                    },
                                                    color: '#1e293b'
                                                }
                                            },
                                            title: {
                                                display: true,
                                                text: 'Lead Status Breakdown',
                                                color: '#1e293b',
                                                font: {
                                                    size: 16,
                                                    weight: 'bold'
                                                }
                                            }
                                        },
                                        animation: {
                                            duration: 1000,
                                            easing: 'easeOutQuart'
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>