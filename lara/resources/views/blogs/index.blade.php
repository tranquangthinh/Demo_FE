@extends('main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>お知らせ一覧</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="col-6">
              <div class="add-news row">
                <div class="col-3 pt-1">
                  お知らせ新規登録
                </div>
                <div class="col-3">
                  <button type="button" class="btn btn-block btn-outline-primary mb-3" id="register-btn">新規登録</button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <div class="form-group">
                  <div class="row">
                    <div class="col-3">
                      <div class="row">
                        <div class="col">
                          <select class="form-control">
                            <option>一括操作</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>        
                          </select>
                        </div>
                        <div class="col">
                          <button type="button" class="btn btn-block btn-success">適用</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-5">
                      <div class="row">
                        <div class="col">
                          <select id="dateFilter" class="form-control">
                            <option value="">すべての日付</option>
                          </select>
                        </div>
                        <div class="col">
                          <select id="categoryFilter" class="form-control">
                            <option value="">すべてのカテゴリー</option>
                          </select>
                        </div>
                        <div class="col">
                          <button type="button" id="filterButton" class="btn btn-block btn-success">絞り込み</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="example1" class="table">
                  <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Content</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                        @php 
                            $item = $blog['attributes'];
                            $id = $blog['id'];
                        @endphp
                        <tr>
                            <td></td>
                            <td>{{ $item['Title'] }}</td>
                            <td>{{ $item['Author'] }}</td>
                            <td>{{ $item['Content'] }}</td>
                            <td>
                              <button onclick="editFuncion('{{$id}}')">Edit</button>
                              <button onclick="deleteFuncion('{{$id}}')">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script-session')
<script>
  let table;

  function addUniqueOptions(selector, values) {
    var select = $(selector);
    values.forEach(function(value) {
      select.append($('<option>', { value: value, text: value }));
    });
  }

  $(document).ready(function() {
    let option = {
      columnDefs: [
        { orderable: false, targets: 0 }
      ],
      order: [1, 'asc'],
      select: {
        style: 'multi'
      },
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
      }
    };
    table = $('#example1').DataTable(option);

    // 全選択・非選択チェックボックスのchangeイベント
    $(document).on('change', 'thead :checkbox', function() {
      update_text();
    });
    // 各行チェックボックスのchangeイベント
    $(document).on('change', 'tbody :checkbox', function() {
      update_text();
    });

    // // Tableにデータが表示されると、セレクトボックスのオプションに値をセットする。
    // table.on('draw', function() {
    //   // 「日付」列のユニークな値を取得
    //   var uniqueDates = table.column(5).data().unique().sort().toArray();
    //   // 「日付」セレクトボックスにオプションを追加
    //   addUniqueOptions('#dateFilter', uniqueDates);

    //   // 「カテゴリー」列のユニークな値を取得
    //   var uniqueCategories = table.column(3).data().unique().sort().toArray();
    //   // 「カテゴリー」セレクトボックスにオプションを追加
    //   addUniqueOptions('#categoryFilter', uniqueCategories);
    // });

    // 「絞り込み」ボタンクリックで、セレクトボックスの値を取得してフィルターを適用
    $('#filterButton').on('click', function() {
      var dateFilter = $('#dateFilter').val();
      var categoryFilter = $('#categoryFilter').val();

      // 日付フィルターを適用
      //table.column(4).search(dateFilter ? '^' + dateFilter.replace(/\//g, '\\/') + '$' : '', true, false);
      table.column(5).search(dateFilter ? '^' + dateFilter + '$' :  '' , true, false);
      // カテゴリーフィルターを適用
      table.column(3).search(categoryFilter ? '^' + categoryFilter + '$' : '', true, false);

      // 表示を更新
      table.draw();
    });

    $('#register-btn').on('click', function() {
      window.location.href="/register";
    });

  });

  function editFuncion(id) {
    window.location.href="/edit/" + id;
  }

  function deleteFuncion(id) {
    window.location.href="/delete/" + id;
  }

  function update_text() {
    // ここでチェックボックスの状態を更新する処理を実装してください
  }


</script>
@endsection