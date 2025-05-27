<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.edit') @lang('site.dashboard.projects')
        </h1>

        <form action="{{ route('dashboard.projects.update', $project->id) }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <input type="text" name="name" value="{{ old('name', $project->name) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.slug')</label>
                <input type="text" name="slug" value="{{ old('slug', $project->slug) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('slug')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.date_of_build')</label>
                <input type="date" name="date_of_build" value="{{ old('date_of_build', $project->date_of_build) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('date_of_build')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.address')</label>
                <textarea name="address" class="w-full border border-gray-300 rounded p-2">{{ old('address', $project->address) }}</textarea>
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.address_location')</label>
                <textarea name="address_location" class="w-full border border-gray-300 rounded p-2">{{ old('address_location', $project->address_location) }}</textarea>
                @error('address_location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.virtual_location')</label>
                <textarea name="virtual_location" class="w-full border border-gray-300 rounded p-2">{{ old('virtual_location', $project->virtual_location) }}</textarea>
                @error('virtual_location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.scheme_name')</label>
                <input type="text" name="scheme_name" value="{{ old('scheme_name', $project->scheme_name) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('scheme_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.floors_count')</label>
                <input type="number" name="floors_count" value="{{ old('floors_count', $project->floors_count) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('floors_count')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.details')</label>
                <textarea name="details" class="w-full border border-gray-300 rounded p-2">{{ old('details', $project->details) }}</textarea>
                @error('details')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.img')</label>
                <input type="file" name="img" accept="image/*" class="w-full border border-gray-300 rounded p-2">
                @isset($project->img)
                    <img src="{{ Storage::url($project->img) }}" alt="img" class="mt-2 w-32 h-32 rounded">
                @endisset
                @error('img')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.cover_img')</label>
                <input type="file" name="cover_img" accept="image/*"
                    class="w-full border border-gray-300 rounded p-2">
                @isset($project->cover_img)
                    <img src="{{ Storage::url($project->cover_img) }}" alt="cover_img" class="mt-2 w-32 h-32 rounded">
                @endisset
                @error('cover_img')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="show_home" value="1" {{ old('show_home', $project->show_home) ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm font-medium text-gray-700">عرض في الصفحة الرئيسية</span>
                </label>
                @error('show_home')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.status')</label>
                <select name="status" class="w-full border border-gray-300 rounded p-2">
                    <option value="">@lang('site.select_status')</option>
                    <option value="not_started" {{ old('status', $project->status) == 'not_started' ? 'selected' : '' }}>لم يبدأ</option>
                    <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>تحت الإنشاء</option>
                    <option value="done" {{ old('status', $project->status) == 'done' ? 'selected' : '' }}>جاهز</option>
                   </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.status_percent')</label>
                <input type="number" name="status_percent"
                    value="{{ old('status_percent', $project->status_percent) }}"
                    class="w-full border border-gray-300 rounded p-2" min="0" max="100">
                @error('status_percent')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.project_category_id')</label>
                <select name="project_category_id" class="w-full border border-gray-300 rounded p-2">
                    <option value="">@lang('site.select_project_category_id')</option>
                    @foreach ($projectCategories as $option)
                        <option value="{{ $option->id }}"
                            {{ old('project_category_id', $project->project_category_id) == $option->id ? 'selected' : '' }}>{{ $option->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.sort_id')</label>
                <input type="number" name="sort_id" value="{{ old('sort_id', $project->sort_id) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('sort_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.update')
            </button>
        </form>
    </div>
</x-app-layout>
