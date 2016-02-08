<?php
// #TODO 썸네일만 있고 실제화일이 없는 경우 삭제옵션
?>
<section>

    <h1>긁어오기</h1>

    <form method="post" action="<?= $URL['mapc']['scrap_act']; ?>" role="form">

        <div class="form-group">

            <label>
                유형
            </label>

            <div>
                <label>
                    <input type="radio" name="scrap_type" value="thum" checked="checked" /> 썸네일만들기
                </label>
            </div>

            <div>
                <label>
                    <input type="radio" name="scrap_type" value="rdf" /> RDF(더블린코어)만들기
                </label>
            </div>

            <div>
                <label>
                    <input type="radio" name="scrap_type" value="scrap" /> RDF를 DB에 등록
                </label>
            </div>

            <div>
                <label>
                    <input type="radio" name="scrap_type" value="del" /> 삭제 (지워진 화일 검사하고 DB에서도 지우기)
                </label>
            </div>

        </div>

        <div class="form-group">

            <button type="submit" class="button btn btn-primary btn-large btn-block wymupdate">확인</button>

        </div>

    </form>

</section>
