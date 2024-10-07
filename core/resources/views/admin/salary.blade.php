@extends('admin.layouts.app')

@section('panel')
<div class="row mb-none-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive--sm">
                    <div class="d-flex justify-content-end p-2">
                        <form action="{{ route('admin.salary.index') }}" method="GET" class="d-flex align-items-center">
                            <div class="me-2">
                                <label for="sort">@lang('Sort by Total Direct:')</label>
                                <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                                    <option value="" {{ $sortDirection == '' ? 'selected' : '' }}>@lang('Select')</option>
                                    <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>@lang('High to Low')</option>
                                    <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>@lang('Low to High')</option>
                                </select>
                            </div>
                            <div class="me-2">
                                <label for="search">@lang('Search Username:')</label>
                                <input type="text" name="search" id="search" class="form-control" value="{{ $search }}" placeholder="@lang('Search Username')" oninput="this.form.submit()">
                            </div>
                            <div>
                                <button type="submit" class="btn btn--primary">@lang('Reset')</button>
                            </div>
                        </form>
                    </div>
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('S.No')</th>
                                <th>@lang('User ID')</th>
                                <th>@lang('Username')</th>
                                <th>@lang('Referred By')</th>
                                <th>@lang('Total Direct')</th>
                                <th>@lang('NPM Direct')</th>
                                <th>@lang('Balance')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $key => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $key }}</td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->referrer_username ?? 'N/A' }}</td>
                                <td>{{ $user->total_direct }}</td>
                                <td>{{ $user->npm_direct }}</td>
                                <td>{{ number_format($user->balance, 2) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline--primary editBtn" 
                                        data-id="{{ $user->id }}"
                                        data-username="{{ $user->username }}"
                                        data-total-direct="{{ $user->total_direct }}"
                                        data-npm-direct="{{ $user->npm_direct }}"
                                        data-balance="{{ number_format($user->balance, 2) }}">
                                        <i class="fa-solid fa-eye"></i> @lang('View')
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $users->appends(['sort' => $sortDirection, 'search' => $search])->links() }}
</div>

<!-- Modal for viewing user details -->
<div class="modal fade" id="userModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('User Details')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>@lang('User ID'):</strong> <span id="modal-userid"></span></p>
                <p><strong>@lang('Username'):</strong> <span id="modal-username"></span></p>
                <p><strong>@lang('Total Direct'):</strong> <span id="modal-total-direct"></span></p>
                <p><strong>@lang('NPM Direct'):</strong> <span id="modal-npm-direct"></span></p>
                <p><strong>@lang('Balance'):</strong> <span id="modal-balance"></span></p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    (function($){
        "use strict";
        $('.editBtn').on('click', function() {
            var modal = $('#userModal');
            modal.find('#modal-userid').text($(this).data('id'));
            modal.find('#modal-username').text($(this).data('username'));
            modal.find('#modal-total-direct').text($(this).data('total-direct'));
            modal.find('#modal-npm-direct').text($(this).data('npm-direct'));
            modal.find('#modal-balance').text($(this).data('balance'));
            modal.modal('show');
        });
    })(jQuery);
</script>
@endpush
