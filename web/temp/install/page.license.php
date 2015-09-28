<h1 class="header">라이센스 동의</h1>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return frm_submit(this);">

  <div class="form-group">
    <textarea class="form-control"></textarea>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" id="agree" name="agree" /> <?= _('위 라이센스 규정에 동의합니다.'); ?>
    </label>
  </div>
  <button type="submit" class="btn btn-default">확인</button>

</form>

<script>
function frm_submit(f)
{
    if (!f.agree.checked) {
        alert("라이센스 내용에 동의하셔야 설치가 가능합니다.");
        return false;
    }
    return true;
}
</script>
