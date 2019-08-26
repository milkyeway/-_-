<?php
require __DIR__. '/__connect_db.php';
$page_name = 'data_edit';
$page_title = '編輯資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if(empty($sid)) {
    header('Location: data_list.php');
    exit;
}

$sql = "SELECT * FROM `wine_goods` WHERE `sid`=$sid";
$row = $pdo->query($sql)->fetch();
if(empty($row)) {
    header('Location: data_list.php');
    exit;
}

?>
<?php include __DIR__. '/__html_head.php' ?>
<?php include __DIR__. '/__navbar.php' ?>
<style>
    small.form-text {
        color: red;
    }
</style>
<div class="container">
<div style="margin-top: 2rem;">
    <div class="row">
        <div class="col">
            <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>
                    <form name="form1" onsubmit="return checkForm()">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                        <div class="form-group">
                                <label for="wine">酒名</label>
                                <input type="text" class="form-control" id="wine" name="wine" value="<?= htmlentities($row['wine']) ?>">
                                <small id="wineHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="kind">種類</label>
                                <input type="text" class="form-control" id="kind" name="kind" value="<?= htmlentities($row['kind']) ?>">
                                <small id="kindHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="producing_countries">生產國</label>
                                <input type="text" class="form-control" id="producing_countries" name="producing_countries" value="<?= htmlentities($row['producing_countries']) ?>">
                                <small id="producing_countriesHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="brand">酒莊/品牌</label>
                                <input type="text" class="form-control" id="brand" name="brand" value="<?= htmlentities($row['brand']) ?>">
                                <small id="brandHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="Production_area">產區</label>
                                <input type="text" class="form-control" id="Production_area" name="Production_area" value="<?= htmlentities($row['Production_area']) ?>">
                                <small id="Production_areaHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="years">年份</label>
                                <input type="text" class="form-control" id="years" name="years" value="<?= htmlentities($row['years']) ?>">
                                <small id="yearsHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="capacity">容量</label>
                                <input type="text" class="form-control" id="capacity" name="capacity" value="<?= htmlentities($row['capacity']) ?>">
                                <small id="capacityHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="concentration">濃度</label>
                                <input type="text" class="form-control" id="concentration" name="concentration" value="<?= htmlentities($row['concentration']) ?>">
                                <small id="concentrationHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="price">價錢</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?= htmlentities($row['price']) ?>">
                                <small id="priceHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="Product_brief">商品簡述</label>
                                <input type="text" class="form-control" id="Product_brief" name="Product_brief" value="<?= htmlentities($row['Product_brief']) ?>">
                                <small id="Product_briefHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="Brand_story">品牌故事</label>
                                <input type="text" class="form-control" id="Brand_story" name="Brand_story" value="<?= htmlentities($row['Brand_story']) ?>">
                                <small id="Brand_storyHelp" class="form-text"></small>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit_btn">修改</button>
                    </form>
                </div>
            </div>

        </div>
    </div>






</div>
    <script>
        let info_bar = document.querySelector('#info-bar');
        const submit_btn = document.querySelector('#submit_btn');
        let i, s, item;
        const required_fields = [
            {
                id: 'wine',
                pattern: /^\S{2,}/,
                info: '請填寫正確的酒名資料'
            },
            // {
            //     id: 'email',
            //     pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
            //     info: '請填寫正確的 email 格式'
            // },
            // {
            //     id: 'mobile',
            //     pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
            //     info: '請填寫正確的手機號碼格式'
            // },
        ];

        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }

        //   /[A-Z]{2}\d{8}/i  統一發票

        function checkForm(){
            // 先讓所有欄位外觀回復到原本的狀態
            for(s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            }
            info_bar.style.display = 'none';
            info_bar.innerHTML = '';

            submit_btn.style.display = 'none';

            // 檢查必填欄位, 欄位值的格式
            let isPass = true;

            for(s in required_fields) {
                item = required_fields[s];

                if(! item.pattern.test(item.el.value)){
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                }
            }

            let fd = new FormData(document.form1);

            if(isPass) {
                fetch('data_edit_api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                        submit_btn.style.display = 'block';
                        info_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        if (json.success) {
                            info_bar.className = 'alert alert-success';
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });
            } else {
                submit_btn.style.display = 'block';
            }
            return false; // 表單不出用傳統的 post 方式送出
        }



    </script>
</div>
<?php include __DIR__. '/__html_foot.php' ?>
