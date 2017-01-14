<div class="section sm">
            
    <div class="container">
    
        <div class="row">
        
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            
                <div class="section-title">
                
                    <h2>contact us for help</h2>
                    <p>Expression acceptance imprudence particular had eat unsatiable.</p>
                    
                </div>

            </div>
        
        </div>
        
        <div class="row">

            <div class="col-sm-7 col-md-6 col-md-offset-1 mb-30">
                <div id="msg_frm_contact" class=""></div>
                <form class="contact-form-wrapper" name="frm_contact" id="frm_contact">
                
                    <div class="row">
                    
                        <div class="col-sm-6">
                        
                            <div class="form-group">
                                <label for="inputName">Your Name <span class="font10 text-danger">(required)</span></label>
                                <input id="username" name="username" type="text" class="form-control" placeholder="Enter your name">
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-6">
                        
                            <div class="form-group">
                                <label for="inputEmail">Your Email <span class="font10 text-danger">(required)</span></label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Enter your email address">
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-12">
                        
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" />
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-12">
                        
                            <div class="form-group">
                                <label for="inputMessage">Message <span class="font10 text-danger">(required)</span></label>
                                <textarea id="msg" name="msg" class="form-control" rows="8" data-minlength="50"></textarea>
                            </div>

                        </div>
                        
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-primary mt-5" id="contact_submit">Send Message</button>
                        </div>
                        
                    </div>
                    
                </form>
                
            </div>
            
            <div class="col-sm-5 col-md-4">
            
                <ul class="address-list">
                    <li>
                            <h5>Address</h5>
                            <address> 545, Marina Rd., <br/>Mohammed Bin Rashid Boulevard, <br/>Dubai 123234 </address>
                    </li>
                    <li>
                            <h5>Email</h5><a href="#">{{env('CONTACT_US_EMAIL')}}</a>
                    </li>
                    <li>
                            <h5>Phone Number</h5><a href="#">1-866-599-6674</a>
                    </li>
                    <li>
                            <h5>Skype</h5><a href="#">your_skype_id</a>
                    </li>
                    <li>
                            <h5>Social Networks</h5>
                            <div class="contact-social">
                            
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                            
                            </div>
                    </li>
                        
                </ul>
            
            </div>
            
        </div>

        <div class="contact-map">
        
            <div id="map" data-lat="25.19739" data-lon="55.28821" style="width: 100%; height: 500px;" class="mt-30 mb-10"></div>

            <div class="infobox-wrapper shorter-infobox contact-infobox">
                <div id="infobox">
                    <div class="infobox-address">
                        <h6>We Are Here</h6>
                    </div>
                
                </div>
            </div>
        
        </div>
        
    </div>

</div>

<input type="hidden" id="map_icon" name="" value="{{url('images/00.png')}}">