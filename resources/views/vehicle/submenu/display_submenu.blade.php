<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>
                <input name="select_all" value="1" id="master" type="checkbox" />
                <label for="master"></label>
            </th>
            <th>#</th>
            <th>{{ __('Menu Image') }}</th>
            <th>{{ __('Menu name') }}</th>
            <th>{{ __('scooter / non-scooter') }}</th>
            <th>{{ __('Enable') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menu->submenu as $submenu)
            <tr>
                <td>
                    <input name="id[]" value="{{ $submenu->id }}" id="{{ $submenu->id }}"
                        data-id="{{ $submenu->id }}" class="sub_chk" type="checkbox" />
                    <label for="{{ $submenu->id }}"></label>
                </td>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ $submenu->image }}" class="rounded" width="50" height="50" alt="">
                </td>
                <td>{{ $submenu->name }}</td>
                <td>
                    @if ($submenu->type == 'scooter')
                        <img src="{{ url('images/scooter.png') }}" alt="">
                    @elseif($submenu->type == 'bike')
                        <img src="{{ url('images/non-scooter.png') }}" alt="">
                    @else
                        <img src="{{ url('images/non-scooter.png') }}" alt="">&nbsp;<img
                            src="{{ url('images/scooter.png') }}" alt="">
                    @endif
                </td>
                <td>
                    <label class="switch">
                        <input type="checkbox" name="status"
                            onclick="change_status('admin/submenu',{{ $submenu->id }})"
                            {{ $submenu->status == 1 ? 'checked' : '' }}>
                        <div class="slider"></div>
                    </label>
                </td>
                <td class="d-flex justify-content-center">
                    @if (Auth::user()->load('roles')->roles->contains('title', 'vehicle'))
                        @can('vehicle_custimization_access')
                            <a href="{{ url('vehicle/custimization_type/' . $submenu->id) }}"
                                class="btn btn-primary mr-1">{{ __('Add cutomization') }}</a>
                        @endcan
                    @endif
                    @if (Auth::user()->load('roles')->roles->contains('title', 'admin'))
                        <a href="{{ url('admin/customization_type/' . $submenu->id) }}"
                            class="btn btn-primary mr-1">{{ __('Add cutomization') }}</a>
                    @endif
                    <button type="button" onclick="update_submenu({{ $submenu->id }})" class="btn btn-primary mr-1"
                        data-toggle="modal" data-target="#edit_modal"><i class="fas fa-pencil-alt"></i>
                    </button>
                    <a href="javascript:void(0);" class="table-action ml-2 btn btn-danger btn-action"
                        onclick="deleteData('admin/submenu',{{ $submenu->id }},'Submenu')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
