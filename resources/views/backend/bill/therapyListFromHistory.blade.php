<!DOCTYPE html>
<html>
<head>
<style>
table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
</head>
<body>
                  @if(empty($getNameFromWalkByPatient))

<p>{{ $getNameFromPatient }}</p>
                                            @else
                                            <p>{{ $getNameFromWalkByPatient }}</p>
                                            @endif
                                             @if(empty($getPhoneFromWalkByPatient))
                                            <p class="text-muted mb-1" id="address-details">{{ $getPhoneFromPatient }}</p>
                                            @else
                                            <p class="text-muted mb-1" id="address-details">{{ $getPhoneFromWalkByPatient }}</p>
                                            @endif
<h2>Therapy List</h2>

        <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                        <tr class="table-active">
<th>Sl No</th>
                                            <th scope="col">Therapy</th>
                                         
                                            <th scope="col">Cost</th>
                                            <th scope="col">Setting</th>
                                            <th scope="col" class="text-end">Amount</th>
                                             <th scope="col" class="text-end">Client signature</th>
                                        </tr>
                                        </thead>
                                        <tbody id="products-list">
                                            @foreach($patientTherapyList as $key=>$allPatientTherapyList)

                                            <?php
$getTherapyPrice = DB::table('therapy_lists')->where('name',$allPatientTherapyList->name)->value('amount');

                                              ?>
                                        <tr>
 <td>{{$key+1}}</td>
                                            <td class="text-start">
                                                <span class="fw-medium">{{ $allPatientTherapyList->name }}</span>

                                            </td>
                                          
                                            <td>BDT {{ $getTherapyPrice }}</td>
                                            <td>{{ $allPatientTherapyList->amount }}</td>
                                            <td class="text-end">BDT {{ $allPatientTherapyList->amount*$getTherapyPrice }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                      

                                   

                                        </tbody>
                                    </table><!--end table-->
                                </div>
                                <div style="margin-top:20px;">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td style="width:80%; text-align:right; padding-right:20px;">Total</td>
                                            <td style="width:20%; text-align:right">BDT {{ $totalTherapyAmount }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:80%; text-align:right; padding-right:20px;">Discount</td>
                                            <td style="width:20%; text-align:right">BDT </td>
                                        </tr>
                                        <tr>
                                            <td style="width:80%; text-align:right; padding-right:20px;">Cumulative Amount</td>
                                            <td style="width:20%; text-align:right">BDT </td>
                                        </tr>
                                        <tr>
                                            <td style="width:80%; text-align:right; padding-right:20px;">Grand Total</td>
                                            <td style="width:20%; text-align:right">BDT </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    </div>
                                    
                                   
                                    <!--end table-->

</body>
</html>