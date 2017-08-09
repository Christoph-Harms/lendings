@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($items as $item)
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $item->name }}</div>
                        <div class="panel-body">
                            More details for the item...
                        </div>
                        <div class="panel-footer clearfix">
                            <div class="btn-group pull-right" role="group" aria-label="Available actions">
                                <button
                                        form="form-lend-item-{{ $item->id }}"
                                        class="btn btn-primary"
                                        data-toggle="tooltip"
                                        data-container="body"
                                        title="{{ __('tooltips.lend_item') }}"
                                >
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                </button>
                                @can('delete', \Lendings\Item::class)
                                    <button
                                            form="form-delete-item-{{ $item->id }}"
                                            class="btn btn-danger"
                                            data-toggle="tooltip"
                                            data-container="body"
                                            title="{{ __('tooltips.delete_item') }}"
                                    >
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                @endcan
                            </div>
                            <form action="{{ route('lendings.store') }}" method="POST"
                                  id="form-lend-item-{{ $item->id }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                            </form>
                            <form action="{{ route('items.destroy', ['id' => $item->id]) }}" method="POST"
                                  id="form-delete-item-{{ $item->id }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('userscript')
    <script>
        // activate tooltips for this page
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection