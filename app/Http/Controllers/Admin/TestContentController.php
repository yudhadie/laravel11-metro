<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestData;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class TestContentController extends Controller
{
    public function index()
    {
        return view('admin.test.content.index',[
            'title' => 'Test Data',
            'breadcrumbs' => Breadcrumbs::render('test'),
        ]);
    }

    public function create()
    {
        return view('admin.test.content.create',[
            'title' => 'Add Test Data',
            'breadcrumbs' => Breadcrumbs::render('test'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:test_data|max:255',
        ]);

        $data =  new TestData();
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->save();

        return redirect()->route('test-content.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $data = TestData::FindOrFail($id);

        return view('admin.test.content.show',[
            'title' => 'Detail Test Data',
            'breadcrumbs' => Breadcrumbs::render('test'),
            'data' => $data,
        ]);
    }

    public function edit(string $id)
    {
        $data = TestData::FindOrFail($id);

        return view('admin.test.content.edit',[
            'title' => 'Edit Test Data',
            'breadcrumbs' => Breadcrumbs::render('test'),
            'data' => $data,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:test_data,name,'.$id,
        ], [
            'name.required' => 'Nama wajib diisi!',
            'name.unique' => 'Nama sudah terdaftar, silakan gunakan nama lain!',
        ]);

        $data = TestData::FindOrFail($id);
        $data->update([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $data = TestData::find($id);
        $data->delete();

        return redirect()->route('test-content.index')->with('error', 'Data berhasil dihapus');
    }
}
