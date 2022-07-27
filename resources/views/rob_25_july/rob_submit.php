public function robSubmit(Request $request)
    {
        return DB::transaction(function () use ($request) {
        

        if(Session::get('UserType')==2)
        {
            $approve=1;
        }
        else
        {
            $approve=0;
        }

        $document_type=$request->document_type ?? '';
        $event_date=$request->event_date ?? '';
        $venue_event=$request->venue_event ?? '';
        $user_id=Session('UserID');


        
            $rob_form_id=$request->rob_form_id ?? $request->getid;
            $created_date = date('m/d/Y');
            $table='[rob_documents]';
            
            $existData=DB::table('rob_forms')->select('*')->where('Pk_id',$rob_form_id)->first();
            //update last tab in rob_form table 

            if ($request->hasFile('detail_report')) 
            {  
                $file = $request->file('detail_report');
                $filename2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $filename2);
            }
            else
            {
                $filename2='';
            }

            if ($request->hasFile('video')) 
            {  
                $file = $request->file('video');
                $video = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video);
            }
            else
            {
                $video=$existData->video;
            }

            if ($request->hasFile('video2')) 
            {  
                $file = $request->file('video2');
                $video2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video2);
            }
            else
            {
                // $video2='';
                $video2=$existData->video2;
            }

            if ($request->hasFile('video3')) 
            {  
                $file = $request->file('video3');
                $video3 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video3);
            }
            else
            {
                $video3=$existData->video3;
            }

            DB::table('rob_forms')
                ->where('Pk_id',$request->getid)
                ->update([
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "detail_report"=>$filename2,
                    "video"=>$video,
                    "video_caption"=>$request->video_caption ?? $existData->video_caption,
                    "video2"=>$video2,
                    "video2_caption"=>$request->video2_caption ?? $existData->video2_caption,
                    "video3"=>$video3,
                    "video3_caption"=>$request->video3_caption ?? $existData->video3_caption,
                    "status"=>2,
                    "approve" => $approve,
                    "post_venue" =>$request->post_venue
                ]);



             DB::table("rob_documents")->where(['rob_form_id'=>$rob_form_id,"image_type"=>0])->delete(); //add 1 apr   
            if(!empty($request->caption_name[0]) || $request->document_name!=null)
            {
                foreach($request->document_name as $key => $document_name )
                {
                    $caption_name=$request->caption_name[$key];
                    $show_website=$request->show_website[$key] ?? '0';
                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id)) 
                    {
                        $pk_document_id=1;
                    } else 
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    if ($request->hasFile('document_name')) 
                    {  
                        $file = $request->file('document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }
                    else
                    {
                        $filename=$document_modify;
                    }


                        $doc_array=array(
                            "pk_document_id" => $pk_document_id,
                            "rob_form_id" => $request->getid,
                            "event_date" => $event_date,
                            "document_name" => $filename,
                            "caption_name" => $caption_name,
                            "show_website" => $show_website,
                            "created_date" => $created_date,
                            "image_type" => 0 
                        ); 
                        $sql=DB::table('rob_documents')->insert($doc_array);
                } //end foreach
            }
            else
            {    
                if($request->document_name_modify!=null)
                {

                    foreach($request->document_name_modify as $key => $document_name )
                    {
                        $document_modify=$request->document_name_modify[$key] ?? '';
                        $caption_name=$request->caption_name_modify[$key] ?? '';
                        $show_website=$request->show_website_modify[$key] ?? '0';
                        $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                        if (empty($pk_document_id)) 
                        {
                            $pk_document_id=1;
                        } else 
                        {
                            $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                            $pk_document_id++;
                        }
                        
                            $doc_array=array(
                                "pk_document_id" => $pk_document_id,
                                "rob_form_id" => $request->getid,
                                "event_date" => $event_date,
                                "document_name" => $document_modify,
                                "caption_name" => $caption_name,
                                "show_website" => $show_website,
                                "created_date" => $created_date,
                                "image_type" => 0 
                            ); 
                            $sql=DB::table('rob_documents')->insert($doc_array);
                    } //end foreach
                }
            }


            //for press 
            DB::table("rob_documents")->where(['rob_form_id'=>$rob_form_id,"image_type"=>1])->delete(); //add 1 apr 
            if(!empty($request->press_caption_name[0]) || $request->press_document_name!=null)
            {
                foreach($request->press_document_name as $key => $press_document_name)
                {
                    $press_caption_name=$request->press_caption_name[$key] ?? '';
                    $press_show_website=$request->press_show_website[$key] ?? '0';

                    $press_document_name_modify=$request->press_document_name_modify[$key] ?? ''; //when you not choose file
                    $press_caption_name_modify=$request->press_caption_name_modify[$key] ?? ''; 

                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id)) 
                    {
                        // $pk_document_id = 'PKOW1';
                        $pk_document_id=1;
                    } else 
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('press_document_name')) 
                    {  
                        $file = $request->file('press_document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }
                    else
                    {
                        $filename=$press_document_name_modify;
                    }

                        $press_array=array(
                            "pk_document_id"=> $pk_document_id,
                            "rob_form_id"=> $request->getid,
                            "event_date"=> $event_date,
                            "document_name"=> $filename,
                            "caption_name"=> $press_caption_name,
                            "show_website"=> $press_show_website,
                            "created_date"=> $created_date,
                            "image_type"=> '1'  
                        );
                    $sql=DB::table('rob_documents')->insert($press_array);
                } //end foreach
            }
            else
            {
                if($request->press_document_name_modify!=null)
                {
                    foreach($request->press_document_name_modify as $key => $press_document_name)
                    {
                        $document_modify=$request->press_document_name_modify[$key] ?? '';
                        $caption_name=$request->press_caption_name_modify[$key] ?? '';
                        $show_website=$request->press_show_website_modify[$key] ?? '0';

                       $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                        if (empty($pk_document_id)) 
                        {
                            $pk_document_id=1;
                        } else 
                        {
                            $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                            $pk_document_id++;
                        }

                            $press_array=array(
                                "pk_document_id"=> $pk_document_id,
                                "rob_form_id"=> $request->getid,
                                "event_date"=> $event_date,
                                "document_name"=> $document_modify,
                                "caption_name"=> $caption_name,
                                "show_website"=> $show_website,
                                "created_date"=> $created_date,
                                "image_type"=> '1'  
                            );
                        $sql=DB::table('rob_documents')->insert($press_array);
                    } //end foreach
                }
            }
            //press close


        
        
        }); //tansaction close
    } //robSubmit function close