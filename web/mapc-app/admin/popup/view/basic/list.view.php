<!-- Main content -->
<section class="content">

  <h1 class="page-header">팝업</h1>

    <table class="table">
        <tr>
            <td>
                제목
            </td>
            <td>
                화일
            </td>
            <td>
                게시기한
            </td>
            <td>
                활성화
            </td>
            <td>
            </td>
        </tr>
        <?php
            foreach($VIEW['popup_list'] as $key => $popup) {
        ?>
        <tr>
            <td>
                <a href="<?= $URL['core']['root']; ?>admin-popup/edit/seq/<?= $popup['seq']; ?>"><?= $popup['title']; ?></a>
            </td>
            <td>
                <?= $popup['banner']; ?>
            </td>
            <td>
                <?= $popup['expire_date']; ?>
            </td>
            <td>
                <?= ($popup['active']) ? _('활성') : _('비활성'); ?>
            </td>
            <td>
                <a href="<?= $URL['core']['root']; ?>admin-popup/edit/seq/<?= $popup['seq']; ?>" class="btn">편집</a>
                <a href="<?= $URL['core']['root']; ?>admin-popup/del/seq/<?= $popup['seq']; ?>" class="btn del">삭제</a>
            </td>
        </tr>
        <?php
            }
        ?>
        <tr>
            <td>
            </td>
        </tr>
    </table>

    <a href="<?= $URL['core']['root']; ?>admin-popup/edit/" class="btn btn-primary">새로등록</a>

</section>


<script>
$(document).ready(function(){
  $(".del").click(function(){
    if (!confirm("정말 삭제하시겠습니까?")){
      return false;
    }
  });
});
</script>
