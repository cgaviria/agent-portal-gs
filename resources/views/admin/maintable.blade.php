<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel2">
    <div class="x_title">
      <h2>{{$table_title or ''}}<small>(Admin panel)</small></h2>
       
        <ul class="nav navbar-right panel_toolbox">
          @if(isset($add_button_url))
            <li><a id="add_button" href="{{$add_button_url}}"><i class="fa fa-plus-circle"> {{$add_string or 'Add new'}}</i></a></li>
          @endif

          @if(isset($extra_buttons))
            @foreach($extra_buttons as $button)
              <li>&nbsp;</li>
              <li><a id="{{$button['id'] or ''}}" href="{{$button['href']}}"><i class="fa fa-plus-circle"> {{$button['label']}}</i></a></li>
            @endforeach
          @endif
        </ul>
        
        @if(isset($add_button_url_ajax))
        <ul class="nav navbar-right panel_toolbox">
          <li><a href="javascript:chargeModalForm('{{$add_button_url_ajax}}','{{$add_string or ''}}')"><i class="fa fa-plus-circle"> Add new </i></a>
          </li>
        </ul>
        @endif
      <div class="clearfix"></div>
        @if(isset($search_page))
           {!!$search_page!!}
        @endif
    </div>
  </div>
  @if(isset($search_form))
  <div class="x_panel">
    <div class="x_title">
      <h2>{{$search_title or ''}}</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">{!!$search_form or ''!!}
    </div>
  </div>  
  @endif

  <div class="x_panel">
     @if(isset($table_subtitle))
      <div class="x_title">
        <h2><small>{{ $table_subtitle or '' }}</small></h2>
        <div class="clearfix"></div>
      </div>
     @endif
    <table id="admintable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                @foreach($fields as $field)
                  <th>{{$field['label']}}</th>
                @endforeach
            </tr>
        </thead>
        <tfoot>
            <tr>
                @foreach($fields as $field)
                  <th>{{$field['label']}}</th>
                @endforeach
            </tr>
        </tfoot>
    </table>

  </div>
</div>

<script>
  var table;
  $(document).ready(function() {    
      var elem = document.querySelector('.js-switch');
      if(elem != null){
        var init = new Switchery(elem);
      }
      
      $('#admintable').hide();
      table = $("#admintable").DataTable({
        processing: true,
        serverSide: true,
        pageLength: 100,
        fixedHeader: {
            header: true
        },
        ajax:{
          url: '{{ url($url) }}',
          @if(isset($data_send))
            data: function (d) {
              @foreach($data_send['fields'] as $field)
                @if($field['type'] == 'checkbox')
                  d.{{$field['name']}} = $('input[name={{$field['name']}}]:checked').val();
                @elseif($field['type'] == 'select')
                  d.{{$field['name']}} = $('#{{$field['name']}}').find(":selected").val();
                @else
                  d.{{$field['name']}} = $('input[name={{$field['name']}}]').val();
                @endif
              @endforeach
            }
          @endif
        } ,
        columns: [
            @foreach($fields as $field)
              {data: '{{$field['id']}}', name: '{{$field['id']}}', orderable: {{$field['ordenable'] ? 'true' : 'false' }}, searchable: {{$field['searchable'] ? 'true' : 'false' }}   },
            @endforeach
        ],
        @if(isset($checkboxes))
        'columnDefs': [
            {
               'targets': 0,
               'searchable':false,
               'orderable':false,
               "checkboxes": {
                    "selectRow": true
               },
               'render': function (data, type, full, meta){
                   return '<input type="checkbox" class="dt-checkboxes" name="data_id[]" value="' + $('<div/>').text(data).html() + '">';
               }
            }
         ],
         @endif
         'select': {
            'style': 'multi'
         },
        @if(isset($order))
         "order": [
              [{{$order['order']}}, "{{$order['way']}}"]
         ],
        @else
          'order': [[1, 'asc']],
        @endif
        @if(isset($searching))
         "bFilter": {{$searching ? 'true' : 'false'}},
        @endif
        fnInitComplete: function () {
            $('#admintable').show();
        }
    });
  });

  @if(isset($data_send))
    $('#{{$data_send['id']}}').on('submit', function(e) {
        e.preventDefault();
    });
  @endif

  function refreshTable(){
    table = $('#admintable').DataTable().ajax.reload();
  }

</script>