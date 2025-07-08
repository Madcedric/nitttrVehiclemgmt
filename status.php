<?php
include_once("server.php");
require_once 'auth.php';
requireLogin();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$requests = handleStatus();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Registration Status</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .header-text p {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
        }

        .header-banner {
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .logo img {
            width: 110px;
            padding: 2px;
            margin-right: 5px;
            height: 110px;
            object-position: 0.01px 2px;
            object-fit: contain;
        }

        .main-content {
            flex: 1;
            padding: 40px 20px;
        }

        .status-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            text-align: center;
            color: #0a3d62;
            margin-bottom: 30px;
            font-size: 32px;
            font-weight: 700;
        }

        .status-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .status-table th {
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border: none;
        }

        .status-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .status-table tr:hover {
            background-color: #f8f9fa;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-approved {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: background-color 0.3s;
        }

        .btn-approve:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: background-color 0.3s;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }

        .btn-back {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #0056b3;
            color: white;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .no-records {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 40px;
        }

        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-text h1 {
                font-size: 24px;
            }

            .status-table {
                font-size: 14px;
            }

            .status-table th,
            .status-table td {
                padding: 10px 8px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .page-title {
                font-size: 24px;
            }
        }

        @media (max-width: 600px) {
            .status-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>
    <!-- Header Banner -->
    <header class="header-banner">
        <div class="header-content">
            <div class="logo-container">
                <div class="logo">
                    <img src="./images/nitttrlogo.png" alt="NITTTR Logo">
                </div>
                <div class="header-text">
                    <h1>National Institute of Technical Teachers Training and Research</h1>
                    <p>[MINISTRY OF EDUCATION, GOVT. OF INDIA] <br> Taramani, Chennai 600113 Tamilnadu</p>
                </div>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="status-container">
            <a href="vehicleRegister.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Registration
            </a>

            <h2 class="page-title">Vehicle Registration Status</h2>


            <?php if (isset($requests) && count($requests) > 0): ?>
                <div class="table-responsive">
                    <table class="status-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i>ID</th>
                                <th><i class="fas fa-user"></i> Name</th>
                                <th><i class="fas fa-briefcase"></i> Designation</th>
                                <th><i class="fas fa-clock"></i> Arrival Time</th>
                                <th><i class="fas fa-clock"></i> Departure Time</th>
                                <th><i class="fas fa-map-marker-alt"></i> Place</th>
                                <th><i class="fas fa-bullseye"></i> Purpose</th>
                                <th><i class="fas fa-info-circle"></i> Status</th>
                                <th><i class="fas fa-calendar"></i> Submitted</th>
                                <th><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $request): ?>
                                
                                <tr>
                                    <td><?php echo htmlspecialchars($request['vRegid']);?></td>
                                    <td><?php echo htmlspecialchars($request['name']); ?></td>
                                    <td><?php echo htmlspecialchars($request['designation']); ?></td>
                                    <td><?php echo htmlspecialchars($request['arrTime']); ?></td>
                                    <td><?php echo htmlspecialchars($request['deptTime']); ?></td>
                                    <td><?php echo htmlspecialchars($request['place']); ?></td>
                                    <td><?php echo htmlspecialchars($request['purpose']); ?></td>
                                    <td>
                                        <?php 
                                        $status = $request['resp_status'];
                                        $badge_class = '';
                                        switch($status) {
                                            case 'approved':
                                                $badge_class = 'status-approved';
                                                break;
                                            case 'rejected':
                                                $badge_class = 'status-rejected';
                                                break;
                                            default:
                                                $badge_class = 'status-pending';
                                                $status = 'pending';
                                        }
                                        ?>
                                        <span class="status-badge <?php echo $badge_class; ?>">
                                            <?php echo ucfirst($status); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y H:i', strtotime($request['created_at'])); ?></td>
                                    <td>
                                        <?php if ($request['resp_status'] === 'pending'): ?>
                                            <div class="action-buttons">
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="status">
                                                    <input type="hidden" name="request_id" value="<?php echo $request['vRegid']; ?>">
                                                    <input type="hidden" name="status" value="approved">
                                                    
                                                </form>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="status">
                                                    <input type="hidden" name="request_id" value="<?php echo $request['vRegid']; ?>">
                                                    <input type="hidden" name="status" value="rejected">
                                                    
                                                </form>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted">
                                                <i class="fas fa-lock"></i> Finalized
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-records">
                    <i class="fas fa-inbox fa-3x" style="color: #ccc; margin-bottom: 20px;"></i>
                    <h4>No vehicle registration requests found</h4>
                    <p>When users submit vehicle registration forms, they will appear here.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> NITTTR. All rights reserved. | Unauthorized access is prohibited.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
