<table  class="table table-hover table-responsive">
    <thead>
        <tr>
            <th class="text-center">Action</th>
            <th class="text-center" data-priority="1">Remarks</th>
            <th class="text-center" data-priority="1">Updated At</th>
            <th class="text-center" data-priority="1">Created By</th>
        </tr>
    </thead>
    <tbody>
        @unless (count($passportchop_result) == 0)
        @foreach ($passportchop_result as $key => $item)
        <tr class="align-center text-center">
            <td class="align-center">
                <a id="{{ $item->id }}" class="btn btn-primary editbtn" href="#modal-view"><i class="bi bi-pencil-square"></i> Edit</a>&nbsp;&nbsp;
                <a id="{{ $item->id }}" class="btn btn-danger delbtn"><i class="bi bi-trash"></i> Delete</a>&nbsp;&nbsp;
                <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($item->chops)}}"><i class="bi bi-eye"></i> View</a>
            </td>
            <td>{{$item->remarks}}</td>
            <td>{{$item->updated_at}}</td>
            <td>{{$item->created_by}}</td>
        </tr>
        @endforeach
        @else
        <tr class="align-center text-center">
            <td class="align-center" colspan="4">
                <h2>No data</h2>
            </td>
        </tr>
        @endunless
    </tbody>
</table>
<div id="paginationPassport" class="justify-content-center">
  {{ $passportchop_result->links() }}
</div>

