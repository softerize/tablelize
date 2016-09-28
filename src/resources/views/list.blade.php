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
                                   href="{{ url($button['url']) }}">
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
                                    <input type="text" name="s" value="{{ old('s', $search) }}" placeholder="Search" class="form-control" />
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
                    <th>Actions</th>
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
                                        || !isset($button['condtion']))
                                    <a class="{{ $button['css'] or config('tablelize.buttons.default') }}"
                                       title="{{ $button['title'] or '' }}"
                                       href="{{ url($button['url'], $row->{$idField}) }}">
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
                            <em>{{ ($noEntriesMsg ? $noEntriesMsg : 'No entries found.') }}</em>
                        </td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr class="active">
                    <td colspan="{{ ($rowActions ? (count($fields) + 1) : count($fields)) }}">
                        <div class="form-inline">
                            <label>
                                Show
                                <select name="ps" class="form-control" onchange="this.form.submit()">
                                    @foreach(array(10 => 10, 25 => 25, 50 => 50) as $key => $value)
                                    <option value="{{ $key }}" <?php echo ($key == old('ps', $pageSize) ? 'selected' : '')?>>
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                </select>
                                entries
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