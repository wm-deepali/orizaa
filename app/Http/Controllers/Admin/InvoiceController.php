<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\State;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    // ================= LIST =================
    public function index(Request $request)
    {
        $query = Invoice::query();

        if ($request->search) {
            $query->where('invoice_no', 'like', '%' . $request->search . '%')
                ->orWhere('customer_name', 'like', '%' . $request->search . '%');
        }

        $invoices = $query->latest()->get();

        return view('admin.invoices.index', compact('invoices'));
    }

    // ================= CREATE =================
    public function create()
    {
        $states = State::all();
        return view('admin.invoices.create', compact('states'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'invoice_no' => 'required|unique:invoices',
            'date' => 'required',
            'customer_name' => 'required',
            'items.*.description' => 'required',
        ]);

        $state = State::find($request->state);

        $invoice = Invoice::create([
            'invoice_no' => $request->invoice_no,
            'date' => $request->date,

            'customer_name' => $request->customer_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $state->name ?? null,
            'state_code' => $request->state_code,
            'gstin' => $request->gstin,
            'zip' => $request->zip,

            'total_taxable' => $request->total_taxable ?? 0,
            'total_tax' => $request->total_tax ?? 0,
            'total_amount' => $request->total_amount ?? 0,

            'amount_in_words' => $request->amount_in_words,
        ]);

        foreach ($request->items as $item) {
            $invoice->items()->create([
                'article_no' => $item['article_no'] ?? null,
                'description' => $item['description'],
                'qty' => $item['qty'] ?? 1,
                'rate' => $item['rate'] ?? 0,
                'discount' => $item['discount'] ?? 0,
                'discount_type' => $item['discount_type'] ?? 'flat',
                'gst' => $item['gst'] ?? 0,
                'price' => $item['price'] ?? 0,
            ]);
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);

        // Needed for state dropdown
        $states = State::all();

        return view('admin.invoices.edit', compact('invoice', 'states'));
    }


    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $request->validate([
            'invoice_no' => 'required|unique:invoices,invoice_no,' . $id,
            'date' => 'required',
            'customer_name' => 'required',
            'items.*.description' => 'required',
        ]);

        // Get state name (same logic as store)
        $state = State::find($request->state);

        // 🔹 Update invoice
        $invoice->update([
            'invoice_no' => $request->invoice_no,
            'date' => $request->date,

            'customer_name' => $request->customer_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $state->name ?? null,
            'state_code' => $request->state_code,
            'gstin' => $request->gstin,
            'zip' => $request->zip,

            'total_taxable' => $request->total_taxable ?? 0,
            'total_tax' => $request->total_tax ?? 0,
            'total_amount' => $request->total_amount ?? 0,

            'amount_in_words' => $request->amount_in_words,
        ]);

        // 🔴 Remove old items (clean approach)
        $invoice->items()->delete();

        // 🔹 Insert new items
        if ($request->items) {
            foreach ($request->items as $item) {
                $invoice->items()->create([
                    'article_no' => $item['article_no'] ?? null,
                    'description' => $item['description'],
                    'qty' => $item['qty'] ?? 1,
                    'rate' => $item['rate'] ?? 0,
                    'discount' => $item['discount'] ?? 0,
                    'discount_type' => $item['discount_type'] ?? 'flat',
                    'gst' => $item['gst'] ?? 0,
                    'price' => $item['price'] ?? 0,
                ]);
            }
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice updated successfully');
    }


    // ================= DELETE =================
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        // Items will auto delete (cascade)
        $invoice->delete();

        // If using AJAX
        return response()->json([
            'message' => 'Invoice deleted successfully'
        ]);

        // OR if normal redirect:
        // return back()->with('success', 'Invoice deleted successfully');
    }

    // ================= ARTICLE SUGGESTIONS =================
    public function articleSuggestions(Request $request)
    {
        $items = InvoiceItem::where(function ($q) use ($request) {
            $q->where('article_no', 'like', '%' . $request->q . '%')
                ->orWhere('description', 'like', '%' . $request->q . '%');
        })
            ->select('article_no', 'description')
            ->distinct()
            ->limit(10)
            ->get();

        return response()->json($items);
    }

    public function getCustomer(Request $request)
    {
        $customer = Invoice::where('mobile', $request->mobile)->latest()->first();

        return response()->json($customer);
    }


    public function show($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);
        return view('admin.invoices.show', compact('invoice'));
    }
    public function viewPdf($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);

        $pdf = Pdf::loadView('admin.invoices.pdf', ['invoice' => $invoice]);
        return $pdf->stream('invoice-' . $invoice->invoice_no . '.pdf');
    }
}