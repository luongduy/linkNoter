
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class = "col-sm-5">
            <div class = "input-group">
               <input id="searchTextbox" type = "text" class = "form-control" placeholder="Search">
               
               <span class = "input-group-btn">
                  <button class = "btn btn-default" type = "button">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
        </div>
        <div class = "col-sm-1">    
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span>&nbsp New
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="addTextbox" placeholder="Paste your link here ...">
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class = "input-group">
                                        <input type="text" class="form-control" id="addTextbox" placeholder="Tag ...">
                                        <span class = "input-group-btn">
                                            <button id="tagAddButton" class = "btn btn-default" type = "button">
                                                <span class="glyphicon glyphicon-plus-sign"></span>
                                             </button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"> 
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <button id="saveLinkButton" class="btn btn-info"><span class="glyphicon glyphicon-save"></span>&nbsp Save</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="label label-info tagLabel"> css </label>
                                    <label class="label label-info tagLabel"> java </label>
                                </div>
                            </div>
                    </li>
                </ul>
            </div>

        </div>
        <div class = "col-sm-1">    
            <button id="tagButton" class = "btn btn-default" type = "button">
                 <span class="glyphicon glyphicon-tags"></span>&nbsp Tag
            </button>
        </div>

     </div>
</div>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-1">
            <div>
                <button class = "btn btn-default center-block voteButton" type = "button">
                         <span class="glyphicon glyphicon-chevron-up"></span>
                </button> 
            </div>
            <div  align="center">
                <label class="voteLabel"> 1234 </label> <br />
            </div>
            <div>
                <button class = "btn btn-default center-block voteButton" type = "button">
                         <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
            </div>
        </div>
        <div class="col-sm-11">
            <br />
            <a href="http://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp">http://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp</a>
            <label class="label label-warning numberOfViewLabel" style="float: right;"> 1234 views</label>
            <br />
            <button class = "btn btn-info tagButton">
                    css
            </button>
        </div>
    </div>
    <hr class="linkHr">
    <div class="row">
        <div class="col-sm-1">
            <div>
                <button class = "btn btn-default center-block voteButton" type = "button">
                         <span class="glyphicon glyphicon-chevron-up"></span>
                </button> 
            </div>
            <div  align="center">
                <label class="voteLabel"> 1234 </label> <br />
            </div>
            <div>
                <button class = "btn btn-default center-block voteButton" type = "button">
                         <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
            </div>
        </div>
        <div class="col-sm-11">
            <br />
            <a href="http://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp">http://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp</a>
            <br />
        </div>
    </div>


</div>

@endsection
