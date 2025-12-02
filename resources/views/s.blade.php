<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>لیست مخاطبین</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #eef1f5;
            font-family: "IRANSans", sans-serif;
        }

        .contact-card {
            border-radius: 18px;
            transition: all 0.3s ease;
            background: #ffffff;
            border: none;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            position: relative;
            overflow: hidden;
        }

        /* hover effect removed */

        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e0e6ed;
        }

        .badge-role {
            font-size: 12px;
            padding: 7px 12px;
            background: #007bff;
            color: #fff;
            border-radius: 25px;
        }

        .info-box {
            background: #f7f9fc;
            padding: 10px 12px;
            border-radius: 12px;
            margin-bottom: 8px;
        }

        .info-title {
            font-weight: bold;
            font-size: 13px;
            color: #444;
        }

        .icon-box {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #e9edf3;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: #5a6a85;
        }

        .action-btn {
            border-radius: 10px;
            font-size: 14px;
            padding: 5px 12px;
        }

        .desc-box {
            background: #f1f4fa;
            padding: 12px;
            border-radius: 12px;
            height: 90px;
            overflow-y: auto;
        }


        .custom-header {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .custom-header .title-section {
            color: #1e293b; /* Darker, more professional color */
            font-size: 1.5rem;
            font-weight: 700;
        }

        .custom-header .title-section i {
            font-size: 1.75rem;
            color: #3b82f6; /* A nice blue for the icon */
            margin-left: 0.75rem;
        }

        .custom-header .search-input-group {
            max-width: 320px;
            border-radius: 12px;
            overflow: hidden; /* Ensures the border-radius is applied to all corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease-in-out;
        }

        .custom-header .search-input-group:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .custom-header .search-input-group .input-group-text {
            background-color: #f1f5f9;
            border: none;
            color: #64748b;
        }

        .custom-header .search-input-group .form-control {
            border: none;
            background-color: #f1f5f9;
            font-size: 0.95rem;
        }
        
        .custom-header .search-input-group .form-control::placeholder {
            color: #94a3b8;
        }

        .custom-header .btn-add-contact {
            background-color: #10b981; /* A modern emerald green */
            border-color: #10b981;
            border-radius: 12px;
            font-weight: 500;
            padding: 0.6rem 1.5rem;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
        }

        .custom-header .btn-add-contact:hover {
            background-color: #059669;
            border-color: #059669;
            transform: translateY(-2px); /* Subtle lift effect */
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
        }

        .custom-header .btn-add-contact i {
            font-size: 1.1rem;
            margin-left: 0.5rem;
        }
    </style>
</head>

<body>
<div class="container mt-5">

        <div class="custom-header">
            <div class="row align-items-center">
                <!-- Title Section -->
                <div class="col-md-4 col-lg-3 mb-3 mb-md-0">
                    <div class="title-section d-flex align-items-center">
                        <i class="bi bi-people-fill"></i>
                        لیست مخاطبین
                    </div>
                </div>

                <!-- Actions Section (Search + Button) -->
                <div class="col-md-8 col-lg-9">
                    <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-sm-end gap-3">
                        <!-- Search Input -->
                        <div class="input-group search-input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="جستجو در مخاطبین...">
                        </div>

                        <!-- Add Button -->
                        <!-- کلاس "ms-3" به اینجا اضافه شده است -->
                        <button class="btn btn-success btn-add-contact text-white mr-1">
                            <i class="bi bi-person-plus"></i>
                            ایجاد مخاطب جدید
                        </button>
                    </div>
                </div>
            </div>
        </div>



    <div class="row">

        <!-- Card Item -->
        <div class="col-md-4 mb-4">
            <div class="card contact-card p-3">

                <!-- Avatar and Header -->
                <div class="text-center">
                    <img src="https://via.placeholder.com/120x120?text=Avatar" class="avatar mb-3">
                    <h5 class="font-weight-bold mb-1">محمد تست</h5>
                    <span class="badge-role">کارشناس شبکه</span>
                </div>

                <!-- Info List -->
                <div class="mt-3">
                    <div class="info-box d-flex align-items-center">
                        <div class="icon-box ml-2"><i class="bi bi-building"></i></div>
                        <div>
                            <div class="info-title">واحد</div>
                            <div>فناوری اطلاعات</div>
                        </div>
                    </div>

                    <div class="info-box d-flex align-items-center">
                        <div class="icon-box ml-2"><i class="bi bi-phone"></i></div>
                        <div>
                            <div class="info-title">موبایل</div>
                            <div>0912-000-1234</div>
                        </div>
                    </div>

                    <div class="info-box d-flex align-items-center">
                        <div class="icon-box ml-2"><i class="bi bi-telephone"></i></div>
                        <div>
                            <div class="info-title">تلفن</div>
                            <div>021-12345678</div>
                        </div>
                    </div>

                    <div class="info-box d-flex align-items-center">
                        <div class="icon-box ml-2"><i class="bi bi-headset"></i></div>
                        <div>
                            <div class="info-title">test</div>
                            <div>3021</div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="desc-box mt-3">
                        پشتیبانی شبکه، مدیریت سرورها، تنظیمات امنیتی و مانیتورینگ.
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-3 d-flex justify-content-between">
                    <button class="btn btn-primary action-btn"><i class="bi bi-pencil-square"></i> ویرایش</button>
                    <button class="btn btn-danger action-btn"><i class="bi bi-trash"></i> حذف</button>
                </div>

            </div>
        </div>

    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation" class="mt-4 d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item disabled"><a class="page-link" href="#">قبلی</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">بعدی</a></li>
        </ul>
    </nav>

</div>
</body>
</html>
