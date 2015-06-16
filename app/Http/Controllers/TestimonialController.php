<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTestimonialRequest;

//use Request;// dont' need it if not using Request facade in the store() method

use App\Testimonial;

class TestimonialController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $testimonials = Testimonial::latest()->get();
            return view('testimonials.index', compact('testimonials'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return view('testimonials.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateTestimonialRequest $request)
	{
            //$input = Request::all();
            //Testimonial::create($input);
            
            Testimonial::create($request->all());
            
//            $testimonial = new Testimonial;
//            $testimonial->author = $input['author'];
//            $testimonial->body = $input['body'];
//            $testimonial->rating = $input['rating'];
            
            return redirect('testimonials');
        }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            Testimonial::destroy($id);
            return redirect('testimonials');

	}

}
