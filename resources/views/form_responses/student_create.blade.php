@extends('layouts.admin.default')

@section('title', $form->title)

@include('layouts.css_and_js.form_advanced')

@section('content')
                <div class="box box-primary" id="guidelines">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>{{ $form->title }}</b></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach(explode('||', $form->description) as $d)
                                  {{ $d }}<br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Form</b></h3>
                    </div>
                    <form role="form" method="post" action="{{ route('form_responses.store', $session_registration_id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                      @foreach($form->form_questions as $fq)
                        <div class="row">
                          <div class="col-md-12">
                            @if($errors->get($fq->code) || session($fq->code))
                              <div class="form-group has-error">
                            @else
                              <div class="form-group">
                            @endif
                                <label for="{{ $fq->code }}">
                                  {{ $fq->question }}
                                  @if($fq->is_required == 'required')
                                    <span style="color:#ff0000; font-weight:normal;">*</span>
                                  @endif
                                </label>
                                @if($fq->answer_type == 'text' || $fq->answer_type == 'email')
                                  <input name="{{ $fq->code }}" type="{{ $fq->answer_type }}" class="@error($fq->code) is-invalid @enderror form-control" placeholder="{{ $fq->placeholder }}" value="{{ old($fq->code) }}">
                                @elseif($fq->answer_type == 'radio')
                                  @foreach($fq->form_question_choices as $fqc)
                                    <br>
                                    <div class="iradio_flat-green">
                                      @if(old($fq->code) == $fqc->answer)
                                        <input checked id="radio{{ $fq->id }}on{{ $fqc->id }}" name="{{ $fq->code }}" type="{{ $fq->answer_type }}" class="flat-red" style="position:absolute; opacity:0;" value="{{ $fqc->answer }}">
                                      @else
                                        <input id="radio{{ $fq->id }}on{{ $fqc->id }}" name="{{ $fq->code }}" type="{{ $fq->answer_type }}" class="flat-red" style="position:absolute; opacity:0;" value="{{ $fqc->answer }}">
                                      @endif
                                      <ins name="{{ $fq->code }}" type="{{ $fq->answer_type }}" class="iCheck-helper" style="position:absolute; opacity:0;" value="{{ $fqc->answer }}"></ins>
                                    </div>
                                    <label for="radio{{ $fq->id }}on{{ $fqc->id }}" class="custom-control-label">{{ $fqc->answer }}</label>
                                  @endforeach
                                  @if(session($fq->code))
                                    <p style="color:red">{{ session($fq->code) }}</p> {{ session([$fq->code => null]) }}
                                  @endif
                                @elseif($fq->answer_type == 'checkbox')
                                  @foreach($fq->form_question_choices as $fqc)
                                    <br>
                                      @if(old($fq->code) == $fqc->answer)
                                        <input checked type="checkbox" class="minimal" value="true" onclick="checkboxClick{{ $fq->id }}on{{ $fqc->id }}(this);" id="checkbox{{ $fq->id }}on{{ $fqc->id }}" name="checkbox{{ $fq->id }}on{{ $fqc->id }}">
                                      @else
                                        <input type="checkbox" class="minimal" value="false" onclick="checkboxClick{{ $fq->id }}on{{ $fqc->id }}(this);" id="checkbox{{ $fq->id }}on{{ $fqc->id }}" name="checkbox{{ $fq->id }}on{{ $fqc->id }}">
                                      @endif
                                      <label for="checkbox{{ $fq->id }}on{{ $fqc->id }}" class="custom-control-label">{{ $fqc->answer }}</label>
                                    <script>
                                      function checkboxClick{{ $fq->id }}on{{ $fqc->id }}(cb) {
                                        document.getElementById("checkbox{{ $fq->id }}on{{ $fqc->id }}").value = cb.checked;
                                      }
                                    </script>
                                  @endforeach
                                  @if(session($fq->code))
                                    <p style="color:red">{{ session($fq->code) }}</p> {{ session([$fq->code => null]) }}
                                  @endif
                                @endif
                                @error($fq->code)
                                  <p style="color:red">{{ $message }}</p>
                                @enderror
                              </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <p style="color:#ff0000;">*) this is required.</p>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- /.box -->
@stop
