<!-- Main content -->
<section class="content">

  <h1 class="page-header">사용자</h1>

  <div id="PersonTableContainer"></div>

  <div class="filtering">
      <form class="form-inline">
        <div class="form-group">
              <button type="button" class="btn btn-primary AddRecordButton">추가</button>
        </div>
        <div class="form-group">
              <input type="text" name="search_name" id="search_name_gjhw" size="7" class="form-control" placeholder="이름"/>
        </div>
        <div class="form-group">
          <select id="search_date_type_gjhw" name="search_date_type" class="form-control" />
              <option value="">전체</option>
              <option value="today">오늘</option>
              <option value="yesterday">어제</option>
              <option value="this_month">이번달</option>
              <option value="last_month">지난달</option>
          </select>
          <input type="text" name="search_date_from" id="search_date_from_gjhw" size="10" class="form-control" />
          <input type="text" name="search_date_to" id="search_date_to_gjhw" size="10" class="form-control" />
          <button type="submit" id="LoadRecordsButton" class="btn btn-primary">검색</button>
        </div>
      </form>
  </div>

</section><!-- /.content -->
