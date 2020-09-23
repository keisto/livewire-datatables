<div>
    <div class="flex justify-between items-center mb-4 relative">
        <div class="flex-grow mr-6">
            <input type="search" name="query" class="appearance-none block w-full bg-gray-100 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-200 transition-colors duration-300" placeholder="Search" wire:model="query"/>
        </div>
        <div class="flex">
            <div>
                <div class="flex items-center">
                    <label for="paginate" class="whitespace-no-wrap mr-3 mb-0 text-gray-400">Per Page</label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-100 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="paginate" name="paginate" wire:model="paginate">
                            <option value="7" selected>7</option>
                            <option value="25">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                @if (count($checked))
                    <button class="ml-4 bg-red-100 text-red-500 py-3 px-4 border border-red-200 hover:bg-red-500 hover:text-white hover:border-red-700 active:bg-red-700 rounded leading-tight transition-colors duration-300" wire:click="deleteChecked">Delete Selected ({{count($checked)}})</button>
                @endif
            </div>
        </div>
    </div>
    <div class="w-full overflow-x-scroll">
        <table class="table-auto">
            <thead>
                <tr>
                    <td></td>
                    @foreach($columns as $column)
                        <th class="border bg-gray-100 px-4 py-2">
                            {{ $column }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($this->records() as $record)
                    <tr class="tranistion-all duration-300 @if ($this->isChecked($record)) line-through text-red-500 @endif">
                        <td class="border px-4 py-2">
                            <input type="checkbox" value="{{ $record->id }}" wire:model="checked">
                        </td>
                        @foreach($columns as $column)
                            <td class="border px-4 py-2">
                                {{ $record->{$column} }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $this->records()->links() }}
    </div>
</div>
