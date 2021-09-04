<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('dash/assets/css/dashlite.css?ver=2.5.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('dash/assets/css/theme.css?ver=2.5.0')}}">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <input type="hidden" name="asset" id="asset" value="{{asset('')}}">
    <input type="hidden" name="profileId" id="profileId" value="{{$id}}">
    <input type="hidden" name="currentType" id="currentType" value="">

    @php
        $type = 'none';
        $value = 0;
        if (isset($_GET["type"])) {
            $type = $_GET["type"];
            $value = $_GET["value"];
        }
        // dd($type);
    @endphp

    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h5><a href="{{url('/')}}">BACK</a></h5>
                                            <h3 class="nk-block-title page-title">Dashboard</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>Welcome back to dashboard</p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="#"><span>Today</span></a></li>
                                                                        <li><a href="#"><span>Last 7 days</span></a></li>
                                                                        <li><a href="#"><span>Last month</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                
                                
                                <div class="nk-block">
                                    <div class="row g-gs">
                                        <div class="col-lg-7 col-xxl-6">
                                            <div class="card card-bordered h-100" id="audience-overview">
                                                <div class="card-inner">
                                                    <div class="card-title-group pb-3 g-2">
                                                        <div class="card-title card-title-sm">
                                                            <h6 class="title">Marketing Overview</h6>
                                                            <p>An overview of your marketing reach and impressions.</p>
                                                        </div>
                                                        <div class="card-tools">
                                                            <div class="drodown">
                                                                <a href="javascript:void(0);" class="dropdownSelect dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-toggle="dropdown">
                                                                
                                                                    @if ( ($type !== 'none' && $type == 'marketingOverviewDropdown' && $value == "1") || $type == 'none' || ($type !== 'none' && $type !== 'marketingOverviewDropdown') )
                                                                        1 Day
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'marketingOverviewDropdown' && $value == "7")
                                                                        7 Days
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'marketingOverviewDropdown' && $value == "30")
                                                                        30 Days
                                                                    @endif
                                                                    
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li class="marketingOverviewDropdown" data-value="1"><a href="{{url('profile/dashboard/'. $id . '/?type=marketingOverviewDropdown&value=1')}}"><span>1 Day</span></a></li>
                                                                        <li class="marketingOverviewDropdown" data-value="7"><a href="{{url('profile/dashboard/'. $id . '/?type=marketingOverviewDropdown&value=7')}}"><span>7 Days</span></a></li>
                                                                        <li class="marketingOverviewDropdown" data-value="30"><a href="{{url('profile/dashboard/'. $id . '/?type=marketingOverviewDropdown&value=30')}}"><span>30 Days</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="analytic-ov">
                                                        <div class="analytic-data-group analytic-ov-group g-3">
                                                            <div class="analytic-data analytic-ov-data">
                                                                <div class="title">Impressions</div>
                                                                <div class="amount" id="marketingOverviewImpressions">{{$marketingOverview['impressions']}}</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-up"></em><span id="marketingOverviewImpressionsB">{{$marketingOverview['impressionsPercentage']}}</span>%</div>
                                                            </div>
                                                            <div class="analytic-data analytic-ov-data">
                                                                <div class="title">Reach</div>
                                                                <div class="amount" id="marketingOverviewReach">{{$marketingOverview['reach']}}</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-up"></em><span id="marketingOverviewReachB">{{$marketingOverview['reachPercentage']}}</span>%</div>
                                                            </div>
                                                            <div class="analytic-data analytic-ov-data">
                                                                <div class="title">Engagement</div>
                                                                <div class="amount" id="marketingOverviewEngagement">{{$marketingOverview['engagement']}}</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-down"></em><span id="marketingOverviewEngagementB">{{$marketingOverview['engagementPercentage']}}</span>%</div>
                                                            </div>
                                                            <div class="analytic-data analytic-ov-data">
                                                                <div class="title">Duration (Avg)</div>
                                                                <div class="amount" id="marketingOverviewDuration">{{$marketingOverview['duration']}}</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-down"></em><span id="marketingOverviewDurationB">{{$marketingOverview['durationPercentage']}}</span>%</div>
                                                            </div>
                                                        </div>
                                                        <div class="analytic-ov-ck">
                                                            <canvas class="analytics-line-large" id="analyticOvData"></canvas>
                                                        </div>
                                                        <div class="chart-label-group ml-5">
                                                            <div class="chart-label">01 Jun, 2021</div>
                                                            <div class="chart-label d-none d-sm-block">15 Jun, 2021</div>
                                                            <div class="chart-label">30 Jun, 2021</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                        <div class="col-md-6 col-lg-5 col-xxl-3">
                                            <div class="card card-bordered h-100" id="followers">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start pb-3 g-2">
                                                        <div class="card-title card-title-sm">
                                                            <h6 class="title">Reach Summary</h6>
                                                            <p>How has your audience reach trended over time.</p>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Viewers of this month"></em>
                                                        </div>
                                                    </div>
                                                    <div class="analytic-au">
                                                        <div class="analytic-data-group analytic-au-group g-3">
                                                            <div class="analytic-data analytic-au-data">
                                                                <div class="title">Monthly</div>
                                                                <div class="amount">{{$reachSummary['monthly']}}</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-up"></em>{{$reachSummary['monthlyPercentage']}}%</div>
                                                            </div>
                                                            <div class="analytic-data analytic-au-data">
                                                                <div class="title">Weekly</div>
                                                                <div class="amount">{{$reachSummary['weekly']}}</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-down"></em>{{$reachSummary['weeklyPercentage']}}%</div>
                                                            </div>
                                                            <div class="analytic-data analytic-au-data">
                                                                <div class="title">Daily (Avg)</div>
                                                                <div class="amount">{{$reachSummary['daily']}}</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-up"></em>{{$reachSummary['dailyPercentage']}}%</div>
                                                            </div>
                                                        </div>
                                                        <div class="analytic-au-ck">
                                                            <canvas class="analytics-au-chart" id="analyticAuData"></canvas>
                                                        </div>
                                                        <div class="chart-label-group">
                                                            <div class="chart-label">{{date('d M, Y')}}</div>
                                                            {{-- <div class="chart-label">30 Jun, 2021</div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                        <div class="col-md-6 col-lg-5 col-xxl-3">
                                            <div class="card card-bordered h-100" id="marketing-performance">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start pb-3 g-2">
                                                        <div class="card-title card-title-sm">
                                                            <h6 class="title">Marketing Performance</h6>
                                                            <p>How your marketing is performing</p>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Performance of this month"></em>
                                                        </div>
                                                    </div>
                                                    <div class="analytic-wp">
                                                        <div class="analytic-wp-group g-3">
                                                            <div class="analytic-data analytic-wp-data">
                                                                <div class="analytic-wp-graph">
                                                                    <div class="title">Bounce Rate <span>(avg)</span></div>
                                                                    <div class="analytic-wp-ck">
                                                                        <canvas class="analytics-line-small" id="BounceRateData"></canvas>
                                                                    </div>
                                                                </div>
                                                                <div class="analytic-wp-text">
                                                                    <div class="amount amount-sm">{{$marketingPerformance['bounceRate']}}</div>
                                                                    <div class="change"><em class="icon ni ni-arrow-long-up"></em>{{$marketingPerformance['bounceRateVs']}}%</div>
                                                                    <div class="subtitle">vs. Yesterday</div>
                                                                </div>
                                                            </div>
                                                            <div class="analytic-data analytic-wp-data">
                                                                <div class="analytic-wp-graph">
                                                                    <div class="title">Engagement <span>(avg)</span></div>
                                                                    <div class="analytic-wp-ck">
                                                                        <canvas class="analytics-line-small" id="PageviewsData"></canvas>
                                                                    </div>
                                                                </div>
                                                                <div class="analytic-wp-text">
                                                                    <div class="amount amount-sm">{{$marketingPerformance['engagement']}}</div>
                                                                    <div class="change"><em class="icon ni ni-arrow-long-down"></em>{{$marketingPerformance['engagementVs']}}%</div>
                                                                    <div class="subtitle">vs. Yesterday</div>
                                                                </div>
                                                            </div>
                                                            <div class="analytic-data analytic-wp-data">
                                                                <div class="analytic-wp-graph">
                                                                    <div class="title">New Viewers <span>(avg)</span></div>
                                                                    <div class="analytic-wp-ck">
                                                                        <canvas class="analytics-line-small" id="NewUsersData"></canvas>
                                                                    </div>
                                                                </div>
                                                                <div class="analytic-wp-text">
                                                                    <div class="amount amount-sm">{{$marketingPerformance['newViewers']}}</div>
                                                                    <div class="change"><em class="icon ni ni-arrow-long-up"></em>{{$marketingPerformance['newViewersVs']}}%</div>
                                                                    <div class="subtitle">vs. Yesterday</div>
                                                                </div>
                                                            </div>
                                                            <div class="analytic-data analytic-wp-data">
                                                                <div class="analytic-wp-graph">
                                                                    <div class="title">Retention <span>(avg)</span></div>
                                                                    <div class="analytic-wp-ck">
                                                                        <canvas class="analytics-line-small" id="TimeOnSiteData"></canvas>
                                                                    </div>
                                                                </div>
                                                                <div class="analytic-wp-text">
                                                                    <div class="amount amount-sm">{{$marketingPerformance['retention']}}</div>
                                                                    <div class="change"><em class="icon ni ni-arrow-long-up"></em>{{$marketingPerformance['retentionVs']}}%</div>
                                                                    <div class="subtitle">vs. Yesterday</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                        
                                        
                                        <div class="col-lg-7 col-xxl-6">
                                            <div class="card card-bordered h-100" id="traffic-channel">
                                                <div class="card-inner mb-n2">
                                                    <div class="card-title-group">
                                                        <div class="card-title card-title-sm">
                                                            <h6 class="title">Traffic Channel</h6>
                                                            <p>Top traffic channel metrics.</p>
                                                        </div>
                                                        <div class="card-tools">
                                                            <div class="drodown">
                                                                <a href="javascript:void(0);" class="dropdownSelect dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-toggle="dropdown">
                                                                    
                                                                    @if ( ($type !== 'none' && $type == 'trafficChannelDropdown' && $value == "1") || $type == 'none' || ($type !== 'none' && $type !== 'trafficChannelDropdown') )
                                                                        1 Day
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'trafficChannelDropdown' && $value == "7")
                                                                        7 Days
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'trafficChannelDropdown' && $value == "30")
                                                                        30 Days
                                                                    @endif

                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li class="trafficChannelDropdown" data-value="1"><a href="{{url('profile/dashboard/'. $id . '/?type=trafficChannelDropdown&value=1')}}"><span>1 Day</span></a></li>
                                                                        <li class="trafficChannelDropdown" data-value="7"><a href="{{url('profile/dashboard/'. $id . '/?type=trafficChannelDropdown&value=7')}}"><span>7 Days</span></a></li>
                                                                        <li class="trafficChannelDropdown" data-value="30"><a href="{{url('profile/dashboard/'. $id . '/?type=trafficChannelDropdown&value=30')}}"><span>30 Days</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-list is-loose traffic-channel-table">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col nk-tb-channel"><span>Channel</span></div>
                                                        <div class="nk-tb-col nk-tb-sessions"><span>Impressions</span></div>
                                                        <div class="nk-tb-col nk-tb-prev-sessions"><span>Prev Impressions</span></div>
                                                        <div class="nk-tb-col nk-tb-change"><span>Change</span></div>
                                                        <div class="nk-tb-col nk-tb-trend tb-col-sm text-right"><span>Trend</span></div>
                                                    </div><!-- .nk-tb-head -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-channel">
                                                            <span class="tb-lead">Native Ads</span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-sessions">
                                                            <span class="tb-sub tb-amount"><span id="trafficChannelGoogle">{{$trafficChannel['google']}}</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-prev-sessions">
                                                            <span class="tb-sub tb-amount"><span id="trafficChannelGoogleVs">{{$trafficChannel['googleVs']}}</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-change">
                                                            <span class="tb-sub"><span id="trafficChannelGooglePercentage">{{$trafficChannel['googlePercentage']}}%</span> <span class="change"><em class="icon ni ni-arrow-long-up"></em></span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-trend text-right">
                                                            <div class="traffic-channel-ck ml-auto">
                                                                <canvas class="analytics-line-small" id="OrganicSearchData"></canvas>
                                                            </div>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-channel">
                                                            <span class="tb-lead">Social Media</span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-sessions">
                                                            <span class="tb-sub tb-amount"><span id="trafficChannelFacebook">{{$trafficChannel['facebook']}}</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-prev-sessions">
                                                            <span class="tb-sub tb-amount"><span id="trafficChannelFacebookVs">{{$trafficChannel['facebookVs']}}</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-change">
                                                            <span class="tb-sub"><span id="trafficChannelFacebookPercentage">{{$trafficChannel['facebookPercentage']}}%</span> <span class="change"><em class="icon ni ni-arrow-long-down"></em></span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-trend text-right">
                                                            <div class="traffic-channel-ck ml-auto">
                                                                <canvas class="analytics-line-small" id="SocialMediaData"></canvas>
                                                            </div>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-channel">
                                                            <span class="tb-lead">Interstitial Ads</span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-sessions">
                                                            <span class="tb-sub tb-amount"><span id="trafficChannelAdf">{{$trafficChannel['adf']}}</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-prev-sessions">
                                                            <span class="tb-sub tb-amount"><span id="trafficChannelAdfVs">{{$trafficChannel['adfVs']}}</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-change">
                                                            <span class="tb-sub"><span id="trafficChannelAdfPercentage">{{$trafficChannel['adfPercentage']}}%</span> <span class="change"><em class="icon ni ni-arrow-long-down"></em></span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-trend text-right">
                                                            <div class="traffic-channel-ck ml-auto">
                                                                <canvas class="analytics-line-small" id="ReferralsData"></canvas>
                                                            </div>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-channel">
                                                            <span class="tb-lead">Others</span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-sessions">
                                                            <span class="tb-sub tb-amount"><span id="trafficChannelOthers">{{$trafficChannel['others']}}</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-prev-sessions">
                                                            <span class="tb-sub tb-amount"><span id="trafficChannelOthersVs">{{$trafficChannel['othersVs']}}</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-change">
                                                            <span class="tb-sub"><span id="trafficChannelOthersPercentage">{{$trafficChannel['othersPercentage']}}%</span> <span class="change"><em class="icon ni ni-arrow-long-up"></em></span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-trend text-right">
                                                            <div class="traffic-channel-ck ml-auto">
                                                                <canvas class="analytics-line-small" id="OthersData"></canvas>
                                                            </div>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                        
                                        <div class="col-md-4 col-xxl-3" id="loadByDevice">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner h-100 stretch flex-column">
                                                    <div class="card-title-group">
                                                        <div class="card-title card-title-sm">
                                                            <h6 class="title">By Device</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <div class="drodown">
                                                                <a href="javascript:void(0);" class="dropdownSelect dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-toggle="dropdown">

                                                                    @if ( ($type !== 'none' && $type == 'byDeviceDropdown' && $value == "1") || $type == 'none' || ($type !== 'none' && $type !== 'byDeviceDropdown') )
                                                                        1 Day
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'byDeviceDropdown' && $value == "7")
                                                                        7 Days
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'byDeviceDropdown' && $value == "30")
                                                                        30 Days
                                                                    @endif

                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li class="byDeviceDropdown" data-value="1"><a href="{{url('profile/dashboard/'. $id . '/?type=byDeviceDropdown&value=1')}}"><span>1 Day</span></a></li>
                                                                        <li class="byDeviceDropdown" data-value="7"><a href="{{url('profile/dashboard/'. $id . '/?type=byDeviceDropdown&value=7')}}"><span>7 Days</span></a></li>
                                                                        <li class="byDeviceDropdown" data-value="30"><a href="{{url('profile/dashboard/'. $id . '/?type=byDeviceDropdown&value=30')}}"><span>30 Days</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="device-status my-auto">
                                                        <div class="device-status-ck">
                                                            <canvas class="analytics-doughnut" id="deviceStatusData"></canvas>
                                                        </div>
                                                        <div class="device-status-group">
                                                            <div class="device-status-data" id="byDeviceDesktopAjaxResult">
                                                                <em data-color="#798bff" class="icon ni ni-monitor"></em>
                                                                <div class="title">Desktop</div>
                                                                <div class="amount">{{$byDevice['byDeviceDesktop']}}%</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-up"></em><span>{{$byDevice['byDeviceDesktopPercentage']}}%</span></div>
                                                            </div>
                                                            <div class="device-status-data" id="byDeviceMobileAjaxResult">
                                                                <em data-color="#baaeff" class="icon ni ni-mobile"></em>
                                                                <div class="title">Mobile</div>
                                                                <div class="amount">{{$byDevice['byDeviceMobile']}}%</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-up"></em><span>{{$byDevice['byDeviceMobilePercentage']}}%</span></div>
                                                            </div>
                                                            <div class="device-status-data" id="byDeviceTabletAjaxResult">
                                                                <em data-color="#7de1f8" class="icon ni ni-tablet"></em>
                                                                <div class="title">Tablet</div>
                                                                <div class="amount">{{$byDevice['byDeviceTablet']}}%</div>
                                                                <div class="change"><em class="icon ni ni-arrow-long-up"></em><span>{{$byDevice['byDeviceTabletPercentage']}}%</span></div>
                                                            </div>
                                                        </div><!-- .device-status-group -->
                                                    </div><!-- .device-status -->
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                        
                                        <div class="col-md-4 col-xxl-3">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group">
                                                        <div class="card-title card-title-sm">
                                                            <h6 class="title">By Country</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <div class="drodown">
                                                                <a href="javascript:void(0);" class="dropdownSelect dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-toggle="dropdown">

                                                                    @if ( ($type !== 'none' && $type == 'byConutryDropdown' && $value == "1") || $type == 'none' || ($type !== 'none' && $type !== 'byConutryDropdown') )
                                                                        1 Day
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'byConutryDropdown' && $value == "7")
                                                                        7 Days
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'byConutryDropdown' && $value == "30")
                                                                        30 Days
                                                                    @endif

                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li class="byConutryDropdown" data-value="1"><a href="{{url('profile/dashboard/'. $id . '/?type=byConutryDropdown&value=1')}}"><span>1 Day</span></a></li>
                                                                        <li class="byConutryDropdown" data-value="7"><a href="{{url('profile/dashboard/'. $id . '/?type=byConutryDropdown&value=7')}}"><span>7 Days</span></a></li>
                                                                        <li class="byConutryDropdown" data-value="30"><a href="{{url('profile/dashboard/'. $id . '/?type=byConutryDropdown&value=30')}}"><span>30 Days</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="analytics-map">
                                                        <div class="vector-map" id="worldMap"></div>
                                                        <table class="analytics-map-data-list" id="byConutryAjaxResult">
                                                            @foreach ($byConutry as $country)
                                                            <tr class="analytics-map-data">
                                                                <td class="country">{{$country->country}}</td>
                                                                <td class="amount">{{$country->total}}</td>
                                                                <td class="percent">{{$country->percentage}}%</td>
                                                            </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                        
                                        <div class="col-md-4 col-xxl-3">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner mb-n2">
                                                    <div class="card-title-group">
                                                        <div class="card-title card-title-sm">
                                                            <h6 class="title">Source</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <div class="drodown">
                                                                <a href="javascript:void(0);" class="dropdownSelect dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-toggle="dropdown">

                                                                    @if ( ($type !== 'none' && $type == 'sourceDropdown' && $value == "1") || $type == 'none' || ($type !== 'none' && $type !== 'sourceDropdown') )
                                                                        1 Day
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'sourceDropdown' && $value == "7")
                                                                        7 Days
                                                                    @endif
                                                                    @if ($type !== 'none' && $type == 'sourceDropdown' && $value == "30")
                                                                        30 Days
                                                                    @endif

                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li class="sourceDropdown" data-value="1"><a href="{{url('profile/dashboard/'. $id . '/?type=sourceDropdown&value=1')}}"><span>1 Day</span></a></li>
                                                                        <li class="sourceDropdown" data-value="7"><a href="{{url('profile/dashboard/'. $id . '/?type=sourceDropdown&value=7')}}"><span>7 Days</span></a></li>
                                                                        <li class="sourceDropdown" data-value="30"><a href="{{url('profile/dashboard/'. $id . '/?type=sourceDropdown&value=30')}}"><span>30 Days</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-list is-compact" id="sourceAjaxResult">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col"><span>Source</span></div>
                                                        <div class="nk-tb-col text-right"><span>Users</span></div>
                                                    </div><!-- .nk-tb-head -->
                                                    
                                                        @foreach ($sources as $source)
                                                        <div class="single-source nk-tb-item">
                                                            <div class="nk-tb-col">
                                                                <span class="tb-sub"><span>{{$source->referral}}</span></span>
                                                            </div>
                                                            <div class="nk-tb-col text-right">
                                                                <span class="tb-sub tb-amount"><span>{{$source->total}}</span></span>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        @endforeach
                                                    

                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                        
                                    </div><!-- .row -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->

    <script>
        
        var byDevice = '<?php echo json_encode($byDevice); ?>';
        var trafficChannel = '<?php echo json_encode($trafficChannel); ?>';
        var reachSummary = '<?php echo json_encode($reachSummary); ?>';
        var marketingPerformance = '<?php echo json_encode($marketingPerformance); ?>';
        var marketingOverview = '<?php echo json_encode($marketingOverview); ?>';
        var byConutry = '<?php echo json_encode($byConutry); ?>';

    </script>


    <script src="{{asset('dash/assets/js/bundle.js?ver=2.5.0')}}"></script>
    <script src="{{asset('dash/assets/js/scripts.js?ver=2.5.0')}}"></script>
    <script src="{{asset('dash/assets/js/charts/gd-analytics.js?ver=2.5.0')}}"></script>
    <script src="{{asset('dash/assets/js/libs/jqvmap.js?ver=2.5.0')}}"></script>



    
</body>

</html>