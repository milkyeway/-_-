<?php
require __DIR__ . '/__connect_db.php';
$page_name = 'data_insert';
$page_title = '新增資料';

?>
<style>
    small {
        color: red;
    }
</style>
<?php include __DIR__ . '/__html_head.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
<div class="container" id="all_form">
    <div style="margin-top: 2rem;">
        <div class="row">
            <div class="col-md">
                <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">新增資料</h5>
                        <form name="form1" onsubmit="return checkForm()">
                            <div class="form-group">
                                <label for="wine">酒名</label>
                                <input type="text" class="form-control" id="wine" name="wine">
                                <small id="wineHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="kind">種類</label>
                                <input type="text" class="form-control" id="kind" name="kind">
                                <small id="kindHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="producing_countries">生產國</label>
                                <input type="text" class="form-control" id="producing_countries" name="producing_countries">
                                <small id="producing_countriesHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="brand">酒莊/品牌</label>
                                <input type="text" class="form-control" id="brand" name="brand">
                                <small id="brandHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="Production_area">產區</label>
                                <input type="text" class="form-control" id="Production_area" name="Production_area">
                                <small id="Production_areaHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="years">年份</label>
                                <input type="text" class="form-control" id="years" name="years">
                                <small id="yearsHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="capacity">容量</label>
                                <input type="text" class="form-control" id="capacity" name="capacity">
                                <small id="capacityHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="concentration">濃度</label>
                                <input type="text" class="form-control" id="concentration" name="concentration">
                                <small id="concentrationHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="price">價錢</label>
                                <input type="text" class="form-control" id="price" name="price">
                                <small id="priceHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="Product_brief">商品簡述</label>
                                <input type="text" class="form-control" id="Product_brief" name="Product_brief">
                                <small id="Product_briefHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="Brand_story">品牌故事</label>
                                <input type="text" class="form-control" id="Brand_story" name="Brand_story">
                                <small id="Brand_storyHelp" class="form-text"></small>
                            </div>
                            <button type="submit" class="btn btn-primary">新增</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>






    </div>
    <script>
        let info_bar = document.querySelector('#info-bar');
        let wine = document.querySelector('#wine');


        function checkForm() {
            // TODO: 檢查必填欄位, 欄位值的格式
            if (wine.value.length < 2) {
                wine.style.border = '1px solid red';
                wine.closest('.form-group').querySelector('small').innerText = '請填寫正確資料';
                return false;
            }

            let fd = new FormData(document.form1);

            fetch('data_insert_api.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(response => {
                    return response.json();
                })
                .then(json => {
                    console.log(json);
                    info_bar.style.display = 'block';
                    info_bar.innerHTML = json.info;
                    if (json.success) {
                        info_bar.className = 'alert alert-success';
                    } else {
                        info_bar.className = 'alert alert-danger';
                    }
                });

            return false; // 表單不出用傳統的 post 方式送出
        }
    </script>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>