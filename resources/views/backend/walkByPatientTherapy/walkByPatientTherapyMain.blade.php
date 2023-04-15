<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Therapy Appointment Date & Time</h4>
        </div><!-- end card header -->
        <div class="card-body">


                <table class="table table-bordered" id="dynamicAddRemove">
                    <tr>
                        <th>Therapist</th>
                        <th>Therapy</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    @foreach($nameList as $allPatientTherapyList)

                    <tr>
                        <td>
                            <select class="form-select mb-3" required aria-label="Default select example" name="therapist[]">
                                @foreach($therapistList as $allTherapistList)
                                <option value="{{ $allTherapistList->id }}">{{ $allTherapistList->name }}</option>
                                @endforeach

                            </select>
                            {{-- <span>ddd</span> --}}
                        </td>
                        <td>

                            <input type="text" required  name="therapy[]" value="{{ $allPatientTherapyList }}"
                                   class="form-control" readonly/>


                        </td>
                        <td>
                            <input type="date" required  name="date[]" value=""
                                   class="form-control"/>
                        </td>
                        <td>
                            <input type="time" required name="start_time[]" value=""
                                   class="form-control"/>
                        </td>
                        <td>
                            <input type="time" required name="end_time[]" value=""
                                   class="form-control"/>
                        </td>

                    </tr>

                    @endforeach
                </table>

        </div>
    </div>
</div>
<div class="text-end mb-3">
    <button type="submit" class="btn btn-primary w-sm" >Submit
    </button>
    </div>
