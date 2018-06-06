<form method="get" action="{{ url($url) }}" role="form" class="tablelize-form" id="{{ $id }}">

    <input type="hidden" name="pps" value="{{ old('pps', $pageSize) }}" />
    <input type="hidden" name="page" value="{{ old('page', $page) }}" />
    <input type="hidden" name="ss" value="{{ old('ss', '') }}" />
    <input type="hidden" name="sf" value="{{ old('sf', $sortField) }}" />
    <input type="hidden" name="so" value="{{ old('so', $sortOrder) }}" />
    <input type="hidden" name="id" value="{{ old('id', $id) }}" />

    @foreach($queryString as $key => $value)
    <input type="hidden" name="{{ $key }}" value="{{ old($key, $value) }}" />
    @endforeach

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr class="active">
                    <td colspan="{{ ($rowActions ? (count($fields) + 1) : count($fields)) }}">
                        <div class="form-inline">
                            @foreach($buttons as $button)
                                @if(is_array($button))
                                <a class="{{ $button['css'] or config('tablelize.buttons.default') }}"
                                   title="{{ $button['title'] or '' }}"
                                   href="{{ url($button['url']) }}"
                                   {!! isset($button['datas']) ? datasTablelize($button['datas']) : '' !!}>
                                    @if(isset($button['icon']))
                                    <span class="{{ $button['icon'] }}"></span>
                                    @endif
                                    {{ $button['text'] }}
                                </a>
                                @else
                                {!! $button !!}
                                @endif
                            @endforeach

                            <div class="pull-right">
                                <div class="input-group">
                                    <input type="text" name="s" value="{{ old('s', $search) }}" placeholder="{{ trans('tablelize::strings.search') }}" class="form-control" />
                                    <span class="input-group-btn">
                                        <button class="{{ config('tablelize.buttons.search') }}" type="submit">
                                            <i class="{{ config('tablelize.icons.search') }}"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="active">
                    @foreach($fields as $field)
                        {!! headerTablelize($id, $field, $sortField, $sortOrder) !!}
                    @endforeach
                    @if($rowActions)
                    <th>{{ trans('tablelize::strings.actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if($entries->count())
                    @foreach($entries as $row)
                    <tr>
                        @foreach($fields as $field)
                        <td>
                            @if(isset($field['escape']) && $field['escape'] === false)
                            {!! fieldTablelize($row, $field) !!}
                            @else
                            {{ fieldTablelize($row, $field) }}
                            @endif
                        </td>
                        @endforeach

                        @if($rowActions)
                        <td>
                            @foreach($rowActions as $button)
                                @if(is_array($button))
                                    @if((isset($button['condition']) && $row->{$button['condition']}())
                                        || !isset($button['condition']))
                                    <a class="{{ $button['css'] or config('tablelize.buttons.default') }}"
                                       title="{{ $button['title'] or '' }}"
                                       href="{{ urlTablelize($row, $button['url'], $idField) }}"
                                       {!! isset($button['datas']) ? datasTablelize($button['datas']) : '' !!}>
                                        @if(isset($button['icon']))
                                        <span class="{{ $button['icon'] }}"></span>
                                        @endif
                                        {{ $button['text'] }}
                                    </a>
                                    @endif
                                @else
                                {!! $button !!}
                                @endif
                            @endforeach
                        </td>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ ($rowActions ? (count($fields) + 1) : count($fields)) }}">
                            <em>{{ ($noEntriesMsg ? $noEntriesMsg : trans('tablelize::strings.noEntriesMsg')) }}</em>
                        </td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr class="active">
                    <td colspan="{{ ($rowActions ? (count($fields) + 1) : count($fields)) }}">
                        <div class="form-inline">
                            <label>
                                {{ trans('tablelize::strings.beforeSize') }}
                                <select name="ps" class="form-control" onchange="this.form.submit()">
                                    @foreach(array(10 => 10, 25 => 25, 50 => 50) as $key => $value)
                                    <option value="{{ $key }}" <?php echo ($key == old('ps', $pageSize) ? 'selected' : '')?>>
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                </select>
                                {{ trans('tablelize::strings.afterSize') }}
                            </label>

                            <div class="pull-right">
                                {!! $entries->appends(
                                        array_merge(
                                            [
                                                's'  => $search,
                                                'ps' => $pageSize,
                                                'sf' => $sortField,
                                                'so' => $sortOrder
                                            ],
                                            $queryString
                                        )
                                    )->render() !!}
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</form>
