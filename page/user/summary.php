<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/user_bar.php'; ?>
<style>
    .btn-hat {
        position: relative;
        height: 250px;
        width: 400px;
        border-radius: 10px;
        background-color: #f1f1f1;
        color: black;
        margin-top: 20px;
        text-align: center;
        padding: 20px;
        box-sizing: border-box;
        border: none;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .btn-hat::before {
        content: '';
        position: absolute;
        top: -5px;
        left: 0;
        width: 100%;
        height: 5px;
        background-color: #7b7b7b;
        border-radius: 10px 10px 0 0;
    }

    .btn-hat:hover {
        background-color: #e0e0e0;
        /* Lighter background on hover */
        transform: scale(1.03);
        /* Slightly increase the size */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Add shadow */
    }

    .btn-hat .text {
        font-size: 20px;
        line-height: 1.2;
        font-weight: bold;
        color: #8e8e8e;
    }

    .btn-hat .icon {
        font-size: 90px;
        margin-top: 10px;
        align-self: flex-end;
        color: #8e8e8e;
    }

    .btn-hat .num {
        font-size: 40px;
        line-height: 1.2;
        font-weight: bold;
        position: relative;
        top: 80px;
        /* Adjust this value as needed */
        align-self: flex-start;
        color: #8e8e8e;
    }
</style>









<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Production Control</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-gray-dark card-outline">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-4 mb-3">
                            <label style="font-weight: bold;">Date From</label>
                            <input type="date" name="date_from" class="form-control form-control-sm" id="date_from">
                        </div>
                        <div class="col-12 col-sm-4 mb-3">
                            <label style="font-weight: bold;">Date To</label>
                            <input type="date" name="date_to" class="form-control form-control-sm" id="date_to">
                        </div>
                        <div class="col-12 col-sm-4 mb-3 d-flex align-items-end">
                            <button class="btn btn-primary btn-block btn-sm" id="generateBtn" style="background-color: #0F78DC; border-color: #0F78DC;">
                                <i class="fas fa-search"></i>&nbsp;Search
                            </button>
                        </div>
                    </div>
              















                <div class="row d-flex justify-content-center">
                    <div class="col-4 d-flex justify-content-center">
                        <a href="report.php">
                            <button type="button" class="btn btn-hat">
                                <div class="text">
                                    Total by Assy<br>Group
                                </div>
                                <div class="num">
                                    123
                                </div>
                                <div class="icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </button>
                        </a>
                    </div>

                    <div class="col-4 d-flex justify-content-center">
                        <a href="report.php">
                            <button type="button" class="btn btn-hat">
                                <div class="text">
                                    Total by Car<br>Model
                                </div>
                                <div class="num">
                                    123
                                </div>
                                <div class="icon">
                                    <i class="fas fa-car"></i>
                                </div>
                            </button>
                        </a>
                    </div>

                    <div class="col-4 d-flex justify-content-center">
                        <a href="report.php">
                            <button type="button" class="btn btn-hat">
                                <div class="text">
                                    Total by Car<br>Maker
                                </div>
                                <div class="num">
                                    123
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>



                <div class="row d-flex justify-content-center">
                    <div class="col-4 d-flex justify-content-center">
                        <a href="report.php">
                            <button type="button" class="btn btn-hat">
                                <div class="text">
                                    Total by Section
                                </div>
                                <div class="num">
                                    123
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </button>
                        </a>
                    </div>

                    <div class="col-4 d-flex justify-content-center">
                        <a href="report.php">
                            <button type="button" class="btn btn-hat">
                                <div class="text">
                                    Total by Car<br>Product
                                </div>
                                <div class="num">
                                    123
                                </div>
                                <div class="icon">
                                    <i class="fas fa-pallet"></i>
                                </div>
                            </button>
                        </a>
                    </div>

                    <div class="col-4 d-flex justify-content-center">
                        <a href="report.php">
                            <button type="button" class="btn btn-hat">
                                <div class="text">
                                    Total
                                </div>
                                <div class="num">
                                    123
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>

            </div>
















        </div>
</div>
</div>
</section>
</div>

<?php include 'plugins/footer.php'; ?>