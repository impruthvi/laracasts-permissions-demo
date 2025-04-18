<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between pb-10">
                        <h3 class="bold text-xl">Articles</h3>
                        @can(App\Enums\ArticleAbilitiesEnum::CREATE, \App\Models\Article::class)
                            <div>
                                <a href="{{ route('articles.create') }}"
                                    class="bg-indigo-500 hover:bg-indigo-600 py-2 px-3 rounded-md text-white">
                                    Create
                                </a>
                            </div>
                        @endcan
                    </div>
                    <table class="w-full ">
                        <thead>
                        <tr>
                            <th class="text-start">Title</th>
                            <th class="text-start">Author</th>
                            <th class="text-start">Published</th>
                            <th class="text-start">Date Created</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr class="border-t-gray-200 border-t">
                                <td class="py-4">{{$article->title}}</td>
                                <td class="py-4">{{ $article->author->name }}</td>
                                <td class="py-4">{{ $article->is_published ? 'Yes' : 'No' }}</td>
                                <td class="py-4">{{ $article->created_at }}</td>
                                <td class="flex py-4 justify-end">
                                    @can('update', $article)
                                    <a href="{{route('articles.edit', ['article' => $article->id])}}"
                                       class="bg-gray-500 hover:bg-gray-600 mr-1 py-2 px-3 rounded-md text-white">
                                        Edit
                                    </a>
                                    @endcan
                                    @can(App\Enums\ArticleAbilitiesEnum::DELETE, $article)
                                    <form
                                        method="post"
                                        action="{{ route('articles.destroy', ['article' => $article->id]) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this article?')"
                                    >
                                        @csrf
                                        @method('delete')
                                        <button
                                            class="bg-red-400 hover:bg-red-500 py-2 px-3 rounded-md text-white">
                                            Delete
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
