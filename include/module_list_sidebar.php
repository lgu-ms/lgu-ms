<?php
$modules = array("Citizen Services and Engagement", "Real Property Tax Management", "Business Permit and Licensing", "Land Use and Zoning", "Public Market and Vendors Management", "Financial Management and Budgeting", "Human Resources and Payroll", "Election and Voter Management", "Emergency Response and Disaster Management", "Solid Waste Management", "Infrastracture and Public Works", "Social Welfare and Community Development", "Health Services and Sanitation", "Document Management and Records", "GIS and Mapping", "Community Engagement and Communication", "Accessibility and Inclusion", "Analytics and Reporting", "Integration and Data Sharing");
$modulesIcon = array("fa-people-group", "fa-building-user", "fa-id-card", "fa-mountain-sun", "fa-shop", "fa-money-bill-wave", "fa-file-invoice", "fa-square-poll-vertical", "fa-truck-medical", "fa-dumpster", "fa-road", "fa-user", "fa-hand-holding-droplet", "fa-record-vinyl", "fa-map", "fa-people-roof", "fa-brands fa-accessible-icon", "fa-chart-pie", "fa-database");
$moduleListSidebar = "";

$count = 1;
foreach ($modules as $module) {

    $moduleListSidebar .= '
    <li class="nav-item module-sidebar">
    <a href="../' . str_replace(" ", "-", strtolower($module)) . '-module" class="nav-link align-middle px-0">
        <i class="fa-solid ' . $modulesIcon[$count - 1] . '"></i> <span class="ms-2 d-none d-sm-inline">  ' . $module . '</span>
    </a>
   </li>';
    $count++;
}
?>