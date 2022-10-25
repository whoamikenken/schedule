<table  class="table table-hover table-responsive">
    <thead>
        <tr>
            <th class="text-center">Action</th>
            <th class="text-center" data-priority="1">Description</th>
            <th class="text-center" data-priority="1">Updated At</th>
            <th class="text-center" data-priority="1">Created By</th>
        </tr>
    </thead>
    <tbody>
        @unless (count($certificate_result) == 0)
        @foreach ($certificate_result as $key => $item)
        <tr class="align-center text-center">
            <td class="align-center">
                <a id="{{ $item->id }}" class="btn btn-primary editbtn" href="#modal-view"><i class="bi bi-pencil-square"></i> Edit</a>&nbsp;&nbsp;
                <a id="{{ $item->id }}" class="btn btn-danger delbtn"><i class="bi bi-trash"></i> Delete</a>&nbsp;&nbsp;
                <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($item->certificate)}}"><i class="bi bi-eye"></i> View</a>
            </td>
            <td>{{$item->description}}</td>
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
<div id="paginationCertificate" class="justify-content-center">
  {{ $certificate_result->links() }}
</div>

