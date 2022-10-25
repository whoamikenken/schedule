<table  class="table table-hover table-responsive">
    <thead>
        <tr>
            <th class="text-center">Action</th>
            <th class="text-center" data-priority="1">Type</th>
            <th class="text-center" data-priority="1">Remarks</th>
            <th class="text-center" data-priority="1">Updated At</th>
            <th class="text-center" data-priority="1">Created By</th>
        </tr>
    </thead>
    <tbody>
        @unless (count($diploma_result) == 0)
        @foreach ($diploma_result as $key => $item)
        <tr class="align-center text-center">
            <td class="align-center">
                <a id="{{ $item->id }}" class="btn btn-primary editbtn" href="#modal-view"><i class="bi bi-pencil-square"></i> Edit</a>&nbsp;&nbsp;
                <a id="{{ $item->id }}" class="btn btn-danger delbtn"><i class="bi bi-trash"></i> Delete</a>&nbsp;&nbsp;
                <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($item->diploma)}}"><i class="bi bi-eye"></i> View</a>
            </td>
            <td>{{$item->type}}</td>
            <td>{{$item->remarks}}</td>
            <td>{{$item->updated_at}}</td>
            <td>{{$item->created_by}}</td>
        </tr>
        @endforeach
        @else
        <tr class="align-center text-center">
            <td class="align-center" colspan="5">
                <h2>No data</h2>
            </td>
        </tr>
        @endunless
    </tbody>
</table>
<div id="paginationDiploma" class="justify-content-center">
  {{ $diploma_result->links() }}
</div>

