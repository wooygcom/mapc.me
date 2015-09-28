<?php
// #TODO 썸네일만 있고 실제화일이 없는 경우 삭제옵션
?>
<section>

    <form method="post" action="<?= $URL['mapc']['scrap_act']; ?>" role="form">

        <div class="form-group">

            <label>
                긁어오기 유형
            </label>

            <div class="checkbox-inline">
                <label>
                    <input type="radio" name="scrap_type" value="scrap" checked="checked" /> 등록 : 화일 긁어와서 DB에 등록
                </label>
            </div>

            <div class="checkbox-inline">
                <label>
                    <input type="radio" name="scrap_type" value="del" /> 삭제 : 지워진 화일 검사하고 DB에서도 지우기
                </label>
            </div>

        </div>

        <div class="form-group">

            <label>
                옵션
            </label>

            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="scrap_option_rdf" value="rdf" checked="checked" /> RDF만들기
                </label>
            </div>

            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="scrap_option_thum" value="thum" checked="checked" /> 썸네일만들기
                </label>
            </div>

            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="scrap_option_db" value="db" checked="checked" /> DB등록
                </label>
            </div>

        </div>


        <div class="form-group">

            <button type="submit" class="btn btn-primary btn-large btn-block wymupdate">확인</button>

        </div>

    </form>

</section>
