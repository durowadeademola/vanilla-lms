
        @if (isset($classDetailItem) && $classDetailItem!=null)
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view panel-refresh">
                        <div class="refresh-container">
                            <div class="la-anim-1"></div>
                        </div>
                        <div class="panel-heading" style="padding: 10px 15px;">
                            <div class="pull-left">
                                <h4 class="panel-title txt-dark">{{ $classDetailItem->code}} :: {{ $classDetailItem->name}} </h4>
                                @if (isset($current_user) && $current_user->lecturer_id == $classDetailItem->lecturer_id)
                                    @if(optional($current_semester)->id == $classDetailItem->semester_id)
                                        <span style="font-size:70%" class="muted txt-danger">You are assigned to teach this class</span>
                                    @else
                                        <span style="font-size:70%" class="muted txt-danger">You were assigned to teach this class</span>
                                    @endif
                                
                                @endif
                                @php
                                $courseClassLecturers = $classDetailItem->getCourseClasslecturers();
                            @endphp
                            @if(isset($current_user) && $current_user->lecturer_id == $classDetailItem->lecturer_id && !empty($courseClassLecturers) && $courseClassLecturers->count() > 0)
                                <div>
                                    <strong style="font-size: 14px">All lecturers assigned to take this course</strong>
                                    <ul >
                                        @foreach($courseClassLecturers as $idx =>$lect)
                                            <li> <i class="text-primary fa fa-angle-double-right mr-5"></i>{{$lect->lecturer->job_title ? $lect->lecturer->job_title : ''}} {{$lect->lecturer->first_name}} {{$lect->lecturer->last_name}} {{$lect->lecturer->email}} {{$lect->lecturer->telephone}}</li>
                                        @endforeach
                                    </ul>
                                </div>     
                            @endif
                            </div>
                            @if ($current_user->lecturer_id != null || $current_user->manager_id != null)
                            <div class="pull-right">
                                <a href="{{ route('dashboard.class',$classDetailItem->id) }}" class="btn btn-xs btn-primary pull-left inline-block mr-15">
                                    <i class="zmdi zmdi-square-right" style="font-size:inherit;color:white;"></i>&nbsp; View
                                </a>
                            </div> 
                            @endif
                            @if ($current_user->student_id != null && $classDetailItem->enrollments->is_approved == true) 
                            <div class="pull-right">
                                <a href="{{ route('dashboard.class',$classDetailItem->id) }}" class="btn btn-xs btn-primary pull-left inline-block mr-15">
                                    <i class="zmdi zmdi-square-right" style="font-size:inherit;color:white;"></i>&nbsp; View
                                </a>
                            </div> 
                            @endif
                            
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="panel-body" style="padding: 10px 15px;">
                            <div class="row">
                                <div class="col-sm-10">
                                
                                    <ul class="list-icons" style="font-size:95%">
                                        @if ($current_user->student_id != null)
                                            @if ($classDetailItem->enrollments->is_approved == "1" )
                                                @if (!empty($classDetailItem->email_address))
                                                <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Class Email: <span class="text-primary">{{ $classDetailItem->email_address }}</span></li>
                                                @endif
                                                @if (!empty($classDetailItem->telephone))
                                                <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Class Phone#: <span class="text-primary">{{ $classDetailItem->telephone }}</span></li>
                                                @endif
                                                <!-- <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Lecture Period: <span class="text-info">Mon, Wed, Fri (3PM to 4PM)</span></li> -->
                                                @if (!empty($classDetailItem->next_lecture_date))
                                                <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Next Lecture: <span id="spn_next_lecture_date" class="text-warning">{{ $classDetailItem->next_lecture_date}}</span></li>
                                                @endif
                                                @if (!empty($classDetailItem->next_exam_date))
                                                <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Next Exam Date: <span id="spn_next_exam_date" class="text-warning">{{ $classDetailItem->next_exam_date}}</span></li>
                                                @endif
                                            <!-- <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Assignment #1 is due Monday, 12-Jun-21 </span></li> -->
                                            <!-- <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Enrolled Students: <span class="text-danger">50</span> </li> -->
                                            <li>                                             
                                                    @php
                                                        $message_response['message'] = $classActivities->get_activity_score($classDetailItem->id, $current_user->student_id);
                                                    @endphp
                                                    @if($message_response['message'] == null && $message_response['total_classs'] == 0)
                                                        <i class="text-danger fa fa-warning mr-5"></i>
                                                        <span class="text-danger">You seem not to be participating in this class. Kindly follow up on reading materials, assignments, and use the discussion forum if you have questions.</span>
                                                    @endif
                                                    @if($message_response['message'] == 'low')
                                                        <i class="text-danger fa fa-warning mr-5"></i>
                                                        <span class="text-danger">Your participation in this class is low, and it might affect your final score. Kindly follow up on reading materials, assignments, and use the discussion forum if you have questions.</span>
                                                    @endif
                                                    @if($message_response['message'] == 'moderate')
                                                        {{-- <span class="text-danger">Your participation in this class is moderate</span> --}}
                                                    @endif
                                                    @if($message_response['message'] == 'high')
                                                        <i class="text-primary fa fa-thimbs-o-up mr-5"></i>
                                                        <span class="text-primary">Your particpation in this class is high, please keep it up.</span>
                                                    @endif
                                            
                                            </li>    
                                            @else
                                            <div class="panel-heading text-center mb-20 mt-10">
                                                <h4 class="text-danger">Your request to enroll in this class has not been approved.</h4>
                                                <p class="muted">Please contact your department to accept your enrollment on this Platform</p>
                                            </div>
                                            @endif
                                        @endif 
                                        @if ($current_user->lecturer_id != null || $current_user->manager_id)
                                            @if (!empty($classDetailItem->email_address))
                                            <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Class Email: <span class="text-primary">{{ $classDetailItem->email_address }}</span></li>
                                            @endif
                                            @if (!empty($classDetailItem->telephone))
                                            <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Class Phone#: <span class="text-primary">{{ $classDetailItem->telephone }}</span></li>
                                            @endif
                                            <!-- <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Lecture Period: <span class="text-info">Mon, Wed, Fri (3PM to 4PM)</span></li> -->
                                            @if (!empty($classDetailItem->next_lecture_date))
                                            <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Next Lecture: <span id="spn_next_lecture_date" class="text-warning">{{ $classDetailItem->next_lecture_date}}</span></li>
                                            @endif
                                            @if (!empty($classDetailItem->next_exam_date))
                                            <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Next Exam Date: <span id="spn_next_exam_date" class="text-warning">{{ $classDetailItem->next_exam_date}}</span></li>
                                            @endif
                                            <!-- <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Assignment #1 is due Monday, 12-Jun-21 </span></li> -->
                                            <!-- <li class="ml-10"><i class="text-primary fa fa-certificate mr-5"></i> Enrolled Students: <span class="text-danger">50</span> </li> -->
                                                 
                                        @endif
                                            
                                    </ul>
                                </div>
                                <!-- <div class="col-sm-6 text-right">
                                    <p style="font-size:80%;" class="text-danger muted">Class outline and notes have NOT been uploaded.</p>
                                    <p style="font-size:80%;" class="text-danger muted">No lectures have been uploaded</p>
                                    <p style="font-size:80%;" class="text-danger muted">No assignments have been assigned</p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
