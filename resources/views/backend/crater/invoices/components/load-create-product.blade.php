<tr>
    <input type="hidden" class="form-control @error('evaluate_quality') is-invalid @enderror" name="product[{{$index}}][item_id]" value="{{$index}}">
    <input type="hidden" class="form-control @error('evaluate_quality') is-invalid @enderror" name="product[{{$index}}][name]" value="{{ $data->title }}">

    <th scope="row">2</th>
    <td>
        <div class="d-block">
            <span class="fw-bold">{{ $data->title }}</span>
            <div class="small text-gray">{{ $data->excerpt }}</div>
        </div>
    </td>
    <td style="width: 12%">
        <input type="number" name="product[{{$index}}][quantity]" min="1" max="100" value="1" class="form-control itemQuantity" id="inputQuantity{{$index}}">
    </td>
    <td style="width: 22%">
        <input type="number" name="product[{{$index}}][price]" min="0" max="100000000" value="{{$data->price}}" class="form-control itemQuantity" id="inputPrice{{$index}}">
    </td>
    <td>
        <input type="number" class="form-control js-change-money" min="0" max="100" placeholder="Thuế" name="product[{{$index}}][tax]" value="0">
    </td>
    <td>
        {{ number_format($data->price? $data->price:0) }}
        <input type="hidden" class="form-control js-change-money js-total" name="product[{{$index}}][total]" value="{{$data->price}}">
    </td>
    <td class="text-center">
        <button class="btn btn-danger btn-sm btnDeleteTr" type="button" data-item_id="{{$data->id}}" data-invoice_id="29">{{__('crater.general.delete')}}</button>
    </td>
</tr>

