<?php

namespace App\Http\Controllers\Admin;

use App\Document;
use App\User;
use App\PropertiesFacturas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocumentsRequest;
use App\Http\Requests\Admin\UpdateDocumentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class DocumentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Document.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('document_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('document_delete')) {
                return abort(401);
            }
            $documents = Document::onlyTrashed()->get();
        } else {
            $documents = Document::all();
        }

        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating new Document.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }

        $properties = \App\Property::get()->pluck('name', 'id');

        return view('admin.documents.create', compact('properties'));
    }

    /**
     * Store a newly created Document in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentsRequest $request)
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }

        $request        = $this->saveFiles($request);
        $document       = Document::create($request->all());
        $documents      = Document::where('tenant_id', $document->tenant_id)->get();
        $notes          = PropertiesFacturas::where('id_tenant', $document->tenant_id)->get();
        $tenant         = User::findOrFail($document->tenant_id);
        $facturas       = PropertiesFacturas::where('id_tenant', $document->tenant_id)->get();

        //dd($document);


      return view('admin.tenants.show', compact('tenant','facturas','documents', 'notes'));
    }


    /**
     * Show the form for editing Document.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }

        $properties = \App\Property::get()->pluck('name', 'id');
        $document   = Document::findOrFail($id);

        return view('admin.documents.edit', compact('document', 'properties'));
    }

    /**
     * Update Document in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentsRequest $request, $id)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $document = Document::findOrFail($id);
        $document->update($request->all());
        $documents      = Document::where('tenant_id', $document->tenant_id)->get();
        $notes          = PropertiesFacturas::where('id_tenant', $document->tenant_id)->get();
        $tenant         = User::findOrFail($document->tenant_id);
        $facturas       = PropertiesFacturas::where('id_tenant', $document->tenant_id)->get();


        return view('admin.tenants.show', compact('tenant','facturas','documents', 'notes'));
    }


    /**
     * Display Document.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('document_view')) {
            return abort(401);
        }

        $document = Document::findOrFail($id);

        return view('admin.documents.show', compact('document'));
    }


    /**
     * Remove Document from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }

        $document = Document::findOrFail($id);
        $document->delete();
        $documents      = Document::where('tenant_id', $document->tenant_id)->get();
        $notes          = PropertiesFacturas::where('id_tenant', $document->tenant_id)->get();
        $tenant         = User::findOrFail($document->tenant_id);
        $facturas       = PropertiesFacturas::where('id_tenant', $document->tenant_id)->get();

      return view('admin.tenants.show', compact('tenant','facturas','documents', 'notes'));
    }

    /**
     * Delete all selected Document at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Document::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Document from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }

        $document = Document::onlyTrashed()->findOrFail($id);
        $document->restore();

        return redirect()->route('admin.documents.index');
    }

    /**
     * Permanently delete Document from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }

        $document = Document::onlyTrashed()->findOrFail($id);
        $document->forceDelete();

        return redirect()->route('admin.documents.index');
    }
}
