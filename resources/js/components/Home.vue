<template>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center mt-5 mb-5" style="font-family: airbnb-light">
                <img id="stendard" src="img/stendard.png" />
                <button type="button" class="btn mt-4" style="width: 122px; height: 40px; "> <span class="mr-1" style="color: #52C41A;">+</span> Add</button>
            </div>
            <div class="mt-5" style="font-size: 12px; color: #777777">
                <ul id="myUL" v-if="componentLoaded">
                    <li>
                        <span class="caret expand" style="display: flex; align-items: center; height: 55px; padding-left: 20px; padding-right: 10px;" @click.stop.prevent="clear()">
                            <span class="material-icons-outlined mr-2" style="font-size: 18px;">face</span>
                            Ahyar Ahfal Imanudin
                        </span>
                        <ul class="nested" style="padding-left: 0px;">
                            <li>
                                <span class="expand" style="display: flex; align-items: center; height: 55px; padding-left: 50px; padding-right: 10px;" @click.stop.prevent="clear()">
                                    <span class="material-icons-outlined mr-2" style="font-size: 18px;">account_box</span>Profile
                                </span>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="expand" style="display: flex; align-items: center; height: 55px; padding-left: 20px; padding-right: 10px;" @click.stop.prevent="clear()">
                            <span class="material-icons-outlined mr-2" style="margin-left: 10px; font-size: 18px;">layers</span>Document Generator
                        </span>
                    </li>
                    <li>
                        <span class="caret expand" style="display: flex; align-items: center; height: 55px; padding-left: 20px; padding-right: 10px;" @click.stop.prevent="clear()">
                            <span class="material-icons-outlined mr-2" style="font-size: 18px;">folder_open</span>
                            Library
                        </span>
                        <ul class="nested" style="padding-left: 0px;">
                            <li v-for="(folder, index) in fileContent" :key="index">
                                <span :class="folder.children.length>0 ? activeLib(index, -1) : activeLib(index, -2)" :draggable="false" @drop.stop="onDrop($event, folder.text)"
                                    @dragover="$event.preventDefault()" @dragenter="enterLib($event,index,-1)" @dragend="stopDrag()" class="expand"
                                    :style="folder.children.length>0 ? 'padding-left: 50px' : 'padding-left: 60px'" style="display: flex; align-items: center; height: 55px; padding-right: 10px;"
                                    @click.stop.prevent="clear()">
                                    <span class="material-icons-outlined mr-2" style="font-size: 18px;">folder_open</span>{{ folder.text }}
                                </span>
                                <ul class="nested" style="padding-left: 0px;" v-if="folder.children.length>0">
                                    <li v-for="(child, id) in folder.children" :key="id">
                                        <span :class="activeLib(index, id)" :draggable="false" @drop.stop="onDrop($event, child.text)" @dragover="$event.preventDefault()"
                                        @dragenter="enterLib($event,index,id)" @dragend="stopDrag()" class="expand"
                                        style="display: flex; align-items: center; height: 55px; padding-left: 80px; padding-right: 10px;"
                                        @click.stop.prevent="clear()">
                                            <span class="material-icons-outlined mr-2" style="font-size: 18px;">folder_open</span>{{ child.text }}
                                        </span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="expand" style="display: flex; align-items: center; height: 55px; padding-left: 20px; padding-right: 10px;" @click.stop.prevent="clear()">
                            <span class="material-icons-outlined mr-2" style="margin-left: 10px; font-size: 18px;">swap_horiz</span>Workflow
                        </span>
                    </li>
                    <li>
                        <span class="expand" style="display: flex; align-items: center; height: 55px; padding-left: 20px; padding-right: 10px;" @click.stop.prevent="clear()">
                            <span class="material-icons-outlined mr-2" style="margin-left: 10px; font-size: 18px;">error_outline</span>Help
                        </span>
                    </li>
                    <li>
                        <span class="expand" style="display: flex; align-items: center; height: 55px; padding-left: 20px; padding-right: 10px;" @click.stop.prevent="clear()">
                            <span class="material-icons-outlined mr-2" style="margin-left: 10px; font-size: 18px;">format_list_numbered</span>Audit Trail
                        </span>
                    </li>
                    <li>
                        <span class="expand" style="display: flex; align-items: center; height: 55px; padding-left: 20px; padding-right: 10px;" @click.stop.prevent="clear()">
                            <span class="material-icons-outlined mr-2" style="margin-left: 10px; font-size: 18px;">history</span>Changelog
                            <div class="ml-4" style="width: 44px; height: 21px; border-radius: 16px; background-color: #1890FF; display: flex; align-items: center; justify-content: center;">
                                <span style="color: #FFFFFF; font-size: 10px">NEW</span>
                            </div>
                        </span>
                    </li>
                </ul>
            </div>
        </nav>
        

        <!-- Page Content -->
        <div id="content">
            <nav :class="{sidebarShadow: showFilter ? true : false }"> </nav>
            <div class="row justify-content-between" id="topNav" style="display: flex; align-items: center;">
                <div id="searchbox" class="col-auto ml-4" style="background-color: #FFFFFF; border-radius: 24px;display: flex; align-items: center; font-family: airbnb-book; height: 38px; padding: 5px 15px 5px 15px">
					<input type="text" placeholder="Search solution..." style="border: none; outline: none;">
                    <span class="material-icons" style="color: #777777; width: 7.5px;">search</span>
				</div>
                <div class="col-auto" style="color: #FFFFFF; display: flex; align-items: center;">
                    <a href="" class="mr-5" style="font-size: 12px;"><u>10 Days left for your trial account</u></a>
                    <button type="button" class="btn mr-5" style="width: 109px; height: 29px; border-radius: 8px; background-color:#EF8019 !important; color: #FFFFFF !important; box-shadow: none; font-size: 10px; font-weight: 600; font-family: airbnb-book;"> Upgrade My Plan</button>
                    <div class="mr-5" style="height: 30px; width: 280px; display: flex; align-items: center; color: #FFFFFF;">
                        <div class="mr-2" style="width: 30px;">
                            <span style="display: block; font-size: 8px; font-weight: 600; font-family: airbnb-book;">Used</span>
                            <span style="display: block; font-size: 10px; font-weight: 600; font-family: airbnb-book;">54 Mb</span>
                        </div>
                        <div class="mr-2" style="width: 205px; height: 6px; background-color:#FFFFFF; display: flex; border-radius: 8px 8px 8px 8px;">
                            <div style="width: 10%; background-color:#FF8717; border-radius: 8px 0px 0px 8px;"></div>
                        </div>
                        <div style="width: 30px;">
                            <span style="display: block; font-size: 8px; font-weight: 600; font-family: airbnb-book;">Total</span>
                            <span style="display: block; font-size: 10px; font-weight: 600; font-family: airbnb-book;">2 Gb</span>
                        </div>
                    </div>
                    <span class="material-icons-outlined mr-5" style="font-size: 24px;">domain</span>
                    <span class="material-icons-outlined mr-5" style="font-size: 24px;">notifications_active</span>
                </div>
                
            </div>
            <div class="wrapperContent">
                <input id="slide-sidebar" type="checkbox" role="button" />
                <label for="slide-sidebar" class="text-center" :class="{showDetails:showDetails,hideDetails:hideDetails}" @click="showing()" id="detailLabel"> 
                    <img src="img/arrow.png" :class="{mirror:mirror}">
                </label>
                <transition name="list"> <nav id="shadow" v-show="showFilter"> </nav> </transition>
                
                <nav id="rightbarext"> </nav>

                <nav id="rightbar">
                    <div class="p-4" v-if="folder" style="height: 94vh">
                        <div class="mt-2 mb-5" style="display: flex;">
                            <button type="button" class="btn mt-1 mr-3" style="width: 88px; border-radius: 10px; height: 40px; color: #07900C !important; box-shadow: none; font-size: 14px; font-weight: 600; font-family: airbnb-book;">Rename</button>
                            <button type="button" class="btn mt-1 mr-2" style="display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; border-radius: 10px; height: 40px; color: #4A4A4A !important; box-shadow: none; font-family: airbnb-book;"><span class="material-icons-outlined" style="font-size: 20px;" >get_app</span></button>
                            <button type="button" class="btn mt-1 mr-2" style="display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; border-radius: 10px; height: 40px; color: #4A4A4A !important; box-shadow: none; font-family: airbnb-book;"><span class="material-icons-outlined" style="font-size: 20px;" >link</span></button>
                            <button type="button" class="btn mt-1 mr-2" style="display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; border-radius: 10px; height: 40px; color: #4A4A4A !important; box-shadow: none; font-family: airbnb-book;"><span class="material-icons-outlined" style="font-size: 20px;" >delete</span></button>
                        </div>

                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Folder Name</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">{{ name }}</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Visibility</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">Anyone with the link</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Owner</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">Ahyar Ahfal Imanudin</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Total Size</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">32 MB</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Created</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">{{ createFolder }}</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Last Update</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">Tuesday, 25-12-2020</span>
                    </div>
                    <div class="p-4" v-if="file">
                        <div class="mt-2 mb-5" style="display: flex;">
                            <button type="button" class="btn mt-1 mr-3" style="width: 88px; border-radius: 10px; height: 40px; color: #07900C !important; box-shadow: none; font-size: 14px; font-weight: 600; font-family: airbnb-book;">Live Edit</button>
                            <button type="button" class="btn mt-1 mr-2" style="display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; border-radius: 10px; height: 40px; color: #4A4A4A !important; box-shadow: none; font-family: airbnb-book;"><span class="material-icons-outlined" style="font-size: 20px;" >get_app</span></button>
                            <button type="button" class="btn mt-1 mr-2" style="display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; border-radius: 10px; height: 40px; color: #4A4A4A !important; box-shadow: none; font-family: airbnb-book;"><span class="material-icons-outlined" style="font-size: 20px;" >link</span></button>
                            <button type="button" class="btn mt-1 mr-2" style="display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; border-radius: 10px; height: 40px; color: #4A4A4A !important; box-shadow: none; font-family: airbnb-book;"><span class="material-icons-outlined" style="font-size: 20px;" >delete</span></button>
                        </div>

                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Document Name</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">{{ name }}</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Visibility</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">Anyone with the link</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Owner</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">Ahyar Ahfal Imanudin</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Format</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">.{{ type }}</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Version</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">001</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Size</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">{{ size }}</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Uploaded</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">Monday, 24-12-2020</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Status</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">{{ status }}</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Last Update</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">{{ lastUpdated }}</span>
                        <span class="mb-1" style="font-size: 12px; color: #BBBBBB; display: block;">Location</span>
                        <span class="mb-4" style="font-size: 14px; color: #4A4A4A; display: block; font-weight: 600; font-family: airbnb-book;">Library</span>

                        <div class="mb-3" style="width: 238px;">
                            <div class="p-3" style="background-color: #E7F3FF; display: flex; align-items: center; border-radius: 8px 8px 0px 0px; height: 44px;">
                                <span style="font-size: 12px; font-weight: 600; font-family: airbnb-book;">Who Can Edit</span>
                            </div>
                            <div class="p-3" style="background-color: #FFFFFF; display: flex; align-items: center; height: 32px;">
                                <span style="font-size: 12px; font-weight: 400; font-family: airbnb-book; color: #777777">Ahyar Ahfal Imanudin</span>
                            </div>
                            <div class="p-3" style="background-color: #FFFFFF; display: flex; align-items: center; height: 32px;">
                                <span style="font-size: 12px; font-weight: 400; font-family: airbnb-book; color: #777777; width: 95%">Aisyah Marlinda Saputri</span>
                                <a href=""><span class="material-icons" style="font-size: 12px; color: #777777; ">close</span></a>
                            </div>
                            <div class="p-3" style="background-color: #FFFFFF; display: flex; align-items: center; height: 32px; border-radius: 0px 0px 8px 8px; ">
                                <a href="" style=""><span style="font-size: 12px; font-weight: 400; font-family: airbnb-book; color: #1890FF; width: 95%">Add Editor</span></a>
                            </div>
                        </div>

                        <div style="width: 238px;">
                            <div class="p-3" style="background-color: #E7F3FF; display: flex; align-items: center; border-radius: 8px 8px 0px 0px; height: 44px;">
                                <span style="font-size: 12px; font-weight: 600; font-family: airbnb-book; width: 90%">Attachment</span>
                                <a href=""><span style="font-size: 12px; font-weight: 600; font-family: airbnb-book; color: #1890FF;">Edit</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="p-4" v-if="thing" style="height: 94vh; display: flex; content-justify: center; content-items: center;">
                        <span>Nothing Selected</span>
                    </div>
                </nav>
                <label class="text-center" id="filterLabel" @click="show()" style="display: flex; align-items: center; justify-content: center; font-size: 14px;">
                    <div style="display: flex; align-items: center; justify-content: center; color: #4A4A4A" :class="{clicked:clicked}">
                        <span class="material-icons"> filter_list </span>
                        <span class="ml-2">Filter</span>
                    </div>
                </label>    
                <div id="filter">
                    <form method="" style="margin-top: 10vh; margin-left: 30px;" >
                        <div class="rowM">
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-size: 10px; font-weight: 600; font-family: airbnb-book;">Document Type</label></div>
                                <select style="width: 230px; height: 30px;outline: none;" class="filterForm">
                                    <option value="" style="color: #000000;" >Manual, procedure, project, etc.</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-size: 10px; font-weight: 600; font-family: airbnb-book;">Format</label></div>
                                <select style="width: 230px; height: 30px;outline: none;" class="filterForm">
                                    <option value="" style="color: #000000;" >pdf, doc, or xls</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-size: 10px; font-weight: 600; font-family: airbnb-book;">Author</label></div>
                                <select style="width: 230px; height: 30px;outline: none;" class="filterForm">
                                    <option value="" style="color: #000000;">-</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-size: 10px; font-weight: 600; font-family: airbnb-book;">Department</label></div>
                                <select style="width: 230px; height: 30px;outline: none;" class="filterForm">
                                    <option value="" style="color: #000000;">Select Department</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="rowM">
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-size: 10px; font-weight: 600; font-family: airbnb-book;">Select Category</label></div>
                                <select style="width: 230px; height: 30px;outline: none;" class="filterForm">
                                    <option value="" style="color: #000000;">Select Category</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-size: 10px; font-weight: 600; font-family: airbnb-book;">File Status</label></div>
                                <select style="width: 230px; height: 30px;outline: none;" class="filterForm">
                                    <option value="" style="color: #000000;">Draft, published, authorized, etc.</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mt-4" style="display: flex; justify-content: center; align-items: center;">
                                <button @click="show()" type="button" class="btnX mr-2" style="display: flex; justify-content: center; align-items: center;width: 61px; height:30px; background-color: #1890FF; color: #FFFFFF; font-size: 10px; border-radius: 4px;"><span class="material-icons mr-1" style="color: #FFFFFF;font-size: 13px; ">close</span>Close</button>
                                <button type="button" class="btnX" style="display: flex; justify-content: center; align-items: center; width: 88px; height: 30px; background-color: #FAFAFA; color: #1890FF; font-size: 10px;border-radius: 4px;"><span class="material-icons mr-1" style="color: #1890FF;font-size: 13px; ">history</span>Reset Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div ref="box" :class="{showDetails:showDetails,hideDetails:hideDetails,showFilter:showFilter,hideFilter:hideFilter}" class="demo-gallery" @click="clear()" @contextmenu="clear()">
                    <!--  -->
                    <div v-if="xx" class="move" :style="{top:topM, left:leftM}" ref="hehe"  style="display: flex; align-items: center;width: 339px !important; height: 74px; border-radius: 8px; padding: 10px;">
                            <div class="mr-2">
                                    <!--  -->
                                <img :src="pictToMove" style="width: 50px;">
                            </div>
                            <div style="width: 261px;">
                                <span style="font-size: 12px; font-weight: 600; font-family: airbnb-book;">{{ fileToMove }}</span>
                            </div>
                    </div>

                    <ul id="right-click-menu" tabindex="-1" ref="rightMenu" v-if="viewMenu" :style="{top:top, left:left}" class="fa-ul" style="font-size: 11px;font-family: airbnb-book; border-radius: 8px; width: 186px; ">
                        <li style="display: flex; align-items: center; padding-left: 10px; padding-left: 10px"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A">visibility</span>Preview</li>
                        <li style="display: flex; align-items: center; padding-left: 10px; color: #078F0C"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #078F0C;">border_color</span>Live Edit</li>
                        <li style="display: flex; align-items: center; padding-left: 10px;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A;">insert_drive_file</span>Edit in Word 365</li>
                        <li style="display: flex; align-items: center; padding-left: 10px;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A;">format_italic</span>Rename</li>
                        <li style="display: flex; align-items: center; padding-left: 10px;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A;">link</span>Copy Link</li>
                        <li style="display: flex; align-items: center; padding-left: 10px;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A;">gamepad</span>Move File</li>
                        <li style="display: flex; align-items: center; padding-left: 10px;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A;">format_list_numbered</span>Start Version Control</li>
                        <li style="display: flex; align-items: center; padding-left: 10px;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A;">swap_horiz</span>See Workflow</li>
                        <li style="display: flex; align-items: center; padding-left: 10px; border-bottom: 1px solid #E0E0E0;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A;">share</span>Share</li>
                        <li style="display: flex; align-items: center; padding-left: 10px;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A;">info</span>Document Info</li>
                        <li style="display: flex; align-items: center; padding-left: 10px; border-bottom: 1px solid #E0E0E0;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #4A4A4A;">download</span>Download</li>
                        <li style="display: flex; align-items: center;color: #E70000; padding-left: 10px;"><span class="material-icons-outlined mr-2" style="font-size: 15px; color: #E70000">delete</span>Delete</li>
                    </ul>
                    <!-- col-xs-6 col-sm-4 col-md-2 col-lg-2  -->
                    <h5 style="margin-top: 9vh; font-size: 16px; color: #4A4A4A">Recent Files</h5>
                    <ul id="lightgallery" class="list-unstyled row" v-if="contentLoaded">
                        <li v-for="(file, index) in getFiles" :key="index" class="text-center mr-1" :draggable="true" @dragstart="startDrag($event, file.id)" @drag="dragging($event)" @dragend="stopDrag()" @contextmenu.stop="openMenu($event, file.id)" :class="active(file.id)" @click.stop.prevent="getDetails(file.id)" style="width: 100px !important; height: 120px !important; display: flex; justify-content: center; align-items: center; padding: 0;">
                            <a href="" :draggable="true" @dragstart="startDrag($event, file.id)" @drag="dragging($event)" @dragend="stopDrag()"
                            style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <div style="width: 80px !important; height: 96px;">
                                     <div style="height: 80px !important; display: flex; justify-content: center; align-items: center;">
                                        <img class="img-responsive" :src="getImg(file.id)" style="width: 70px !important;">
                                    </div>
                                    <div style="height: 16px !important; display: flex; justify-content: center; align-items: center; font-size: 12px; font-family: airbnb-bold;">
                                        <span>{{ file.file.length>9 ? file.file.slice(0, 9).concat(' ..') : file.file }}</span>
                                    </div>
                                </div>
                               
                            </a>
                        </li>
                    </ul>

                    <h5 style="margin-top: 2vh; font-size: 16px; color: #4A4A4A">Folders</h5>
                    <ul class="list-unstyled row" v-if="contentLoaded">
                        <li v-for="(folder, index) in getFolders" :key="index" :draggable="false" @drop.stop="onDrop($event, folder.file)" @dragover="$event.preventDefault()" @dragenter="enter($event,folder.id)" @dragend="stopDrag()" class="text-center mr-1" @click.stop.prevent="getDetails(folder.id)" :class="active(folder.id)" @contextmenu.stop="openMenu($event, folder.id)" style="width: 100px !important; height: 120px !important; display: flex; justify-content: center; align-items: center; padding: 0;">
                            <a href="" :draggable="false" >
                                <div style="width: 80px !important; height: 96px;">
                                     <div style="height: 80px !important; display: flex; justify-content: center; align-items: center;">
                                        <img style="width: 70px !important;" class="img-responsive" :src="getImg(folder.id)" :draggable="false">
                                    </div>
                                    <div style="height: 16px !important; display: flex; justify-content: center; align-items: center; font-size: 12px; font-family: airbnb-bold;">
                                        <span>{{ folder.file.length>9 ? folder.file.slice(0, 9).concat(' ..') : folder.file }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <table id="example" border="0" style="width:100%" v-if="contentLoaded">
                        <thead style="border-bottom: 1px solid #BBBBBB !important; font-family: airbnb-light; font-size: 12px;">
                            <tr>
                                <th style="width: 50%;">
                                    <span class="mr-2" style="float: left">Name</span>
                                    <div style="width: 5px;">
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_up</span>
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_down</span>
                                    </div>
                                </th>
                                <th style="width: 10%">
                                    <span class="mr-2" style="float: left">Doc No</span>
                                    <div style="width: 5px;">
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_up</span>
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_down</span>
                                    </div>
                                </th>
                                <th style="width: 10%">
                                    <span class="mr-2" style="float: left">Size</span>
                                    <div style="width: 5px;">
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_up</span>
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_down</span>
                                    </div>
                                </th>
                                <th style="width: 10%">
                                    <span class="mr-2" style="float: left">Status</span>
                                    <div style="width: 5px;">
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_up</span>
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_down</span>
                                    </div>
                                </th>
                                <th style="width: 10%">
                                    <span class="mr-2" style="float: left">Upload Date</span>
                                    <div style="width: 5px;">
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_up</span>
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_down</span>
                                    </div>
                                </th>
                                <th style="width: 10%">
                                    <span class="mr-2" style="float: left">Last Updated</span>
                                    <div style="width: 5px;">
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_up</span>
                                        <span class="material-icons" style="display:block; font-size: 8px;">keyboard_arrow_down</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- <hr> -->
                        <tr style="height: 20px"></tr>
                        <tbody style="font-size: 11px;">
                            <tr v-for="(file, index) in getFiles" :key="index" @click.stop.prevent="getDetails(file.id)" :class="active(file.id)" :draggable="true"
                            @dragstart="startDrag($event, file.id)" @dragend="stopDrag()" @drag="dragging($event)" @contextmenu.stop="openMenu($event, file.id)" >
                                <td><img class="mr-2" :src="getImg(file.id)" style="width: 30px;">{{file.file}}</td>
                                <td>{{ file.doc_no != '' ? file.doc_no : '-' }}</td>
                                <td>{{file.size}}</td>
                                <td>{{file.file_status}}</td>
                                <td>{{file.last_updated}}</td>
                                <td>{{file.last_updated}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="alert" class="alert alert-secondary alert-dismissible fade show" role="alert" style="display: flex; align-items: center; width: 433px !important; height: 84px !important;">
                    <div style="width: 95%">
                        <span style="display: block; font-size: 14px; font-weight: 600; font-family: airbnb-book;">Successfully move the file to</span>
                        <div class="rowM" style="display: flex; align-items: center;">
                            <div class="columnM">
                                <img src="img/folder.png" style="width: 20px;">
                            </div>
                            <div class="columnM">
                                <span style="color: #4A4A4A;display: block; font-size: 12px; font-weight: 600; font-family: airbnb-book;">{{ folderMove }}</span>
                            </div>
                        </div>
                        
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="clear()" style="outline: none;top: 20%;">
                        <span aria-hidden="true" style="display:block;">&times;</span>
                    </button>
                    
                </div>
                            
            </div>
        </div>

    </div>       
</template>

<script>

    export default {
        data() {
            return {
                lParent:[],
                lChild:[[],[]],
                over: false,
                folderMove: '',
                componentLoaded: false,
                contentLoaded: false,
                fileContent: null,
                content:null,
                name: '',
                createFolder:'',
                type:'',
                size:'',
                lastUpdated:'',
                status:'',
                folder: false,
                file: false,
                thing: true,
                showDetails: false,
                hideDetails: true,
                showFilter: false,
                hideFilter: true,
                clicked: false,
                aRow: [],
                drag:[],
                drop:[],
                mirror: false,
                alert: false,
                viewMenu: false,
                top: '0px',
                left: '0px',
                topM: '0px',
                leftM: '0px',
                xx: false,
                fileToMove: '',
                pictToMove: ''
            }
        },
        created: function(){
            this.getLibrary;
            this.getContent;
            
        },
        computed:{
            getFiles: function() {
                return this.content.filter(function(u) {
                    return u.type === 'file';
                })
            },
            getFolders: function() {
                return this.content.filter(function(u) {
                    return u.type === 'folder';
                })
            },
            getLibrary: function(){
                var self = this;
                
                axios.get("/folder_tree_left_side_bar.json")    
                    .then(function(response){  
                        self.fileContent = response.data;
                        for(let i=0; i<self.fileContent.length; i++){
                            self.lParent.push({'active':false});

                            if(self.fileContent[i].children.length > 0){
                                for(let j=0; j<self.fileContent[i].children.length; j++){
                                    self.lChild[i].push({'active': false});
                                }
                                
                            }
                        }

                    })
                    .then(function(){
                        self.componentLoaded = true;
                    })               
                    .catch(function(err){
                        console.log(err.response);
                    });
            },
            getContent: function(){
                var self = this;

                axios.get("/default_library.json")    
                    .then(function(response){  
                        self.content = response.data;
                        for(let i=0; i<self.content.length; i++){
                            self.aRow.push({'row':false});
                            if(self.content.type == 'folder'){
                                self.drop.push('drop'+i);
                            }else{
                                self.drag.push('drag'+i);
                            }
                        }
                    })
                    .then(function(){
                        self.contentLoaded = true;
                    })               
                    .catch(function(err){
                        console.log(err.response);
                    });
            }
        },
        methods:{
            activeLib: function(index, id){

                return{
                    caret: id === -1 ? true : false,
                    over: id >= 0 ? this.lChild[index][id].active : this.lParent[index].active
                }
            },
            enterLib: function(e, index, id){
                e.preventDefault();
                let temp = 0;

                this.fileContent.forEach((fc, ix)=>{
                    if(fc.children.length>0){
                        temp = ix;
                    }
                })

                this.aRow.forEach(fls=>{
                    fls.row = false;
                });

                this.lParent.forEach(pr=>{
                    pr.active = false;
                });

                this.lChild[temp].forEach(ch=>{
                    ch.active = false;
                });

                if(id != -1){
                    this.lChild[index][id].active=true;
                    console.log('lchild = ',this.lChild[index][id].active);
                }else{
                    this.lParent[index].active=true;
                    console.log('lparent = ',this.lParent[index].active);
                }
            },
            enter: function(e, idd){
                e.preventDefault();

                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                });
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.lParent.forEach(pr=>{
                    pr.active = false;
                });

                let temp = 0;
                this.fileContent.forEach((fc, ix)=>{
                    if(fc.children.length>0){
                        temp = ix;
                    }
                })
                this.lChild[temp].forEach(ch=>{
                    ch.active = false;
                });

                this.aRow[index].row=true;
            },
            stopDrag: function(){
                console.log('xx = ', this.xx=false);
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.lParent.forEach(pr=>{
                    pr.active = false;
                });
                let temp = 0;
                this.fileContent.forEach((fc, ix)=>{
                    if(fc.children.length>0){
                        temp = ix;
                    }
                })
                this.lChild[temp].forEach(ch=>{
                    ch.active = false;
                });
                this.fileToMove = '';
                this.pictToMove = '';
                this.cursor = false;
                // Vue.nextTick(function() {
                    

                    this.topM = '0px';
                    this.leftM = '0px';
                   
                // }.bind(this));
                console.log('tM & lM = ', this.topM, this.leftM);
            },
            movee: function(e){
                
                    Vue.nextTick(function() {
                        if(this.xx){
                            let t = e.offsetY;
                            let l = e.offsetX;

                            console.log('tM = ', t);
                            console.log('lM = ', l);

                            this.topM = t + 'px';
                            this.leftM = l + 'px';
                        }
                    }.bind(this));
                
            },
            check: function(e){
                if(this.xx){
                    Vue.nextTick(function() {
                        let t = e.y-625;
                        let l = e.x-250;

                        console.log('tM = ', t);
                        console.log('lM = ', l);

                        this.topM = t + 'px';
                        this.leftM = l + 'px';
                    }.bind(this));
                }
            },
            setMenu: function(top, left) {
                let t = top-60;
                let l = left-250;


                console.log('t = ', t);
                console.log('l = ', l);


                this.top = t + 'px';
                this.left = l + 'px';
            },

            openMenu: function(e, idd) {
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.alert = false;
                this.folderMove = '';
                this.mirror = true;
                this.aRow[index].row=true;
                this.viewMenu = true;

                if(this.content[index].type == 'folder'){
                    this.name = this.content[index].file;
                    this.createFolder = this.content[index].file.indexOf("on") != -1 ? this.content[index].file.slice(this.content[index].file.indexOf("on")+3) : '-';
                    this.file = false;
                    this.thing = false;
                    this.folder = true;
                } else{
                    this.name = this.content[index].file;
                    this.type = this.content[index].file_type;
                    this.lastUpdated = this.content[index].last_updated;
                    this.status = this.content[index].file_status;
                    this.size = this.content[index].size;
                    this.file = true;
                    this.thing = false;
                    this.folder = false;
                }
                
                Vue.nextTick(function() {
                    this.$refs.rightMenu.focus();

                    this.setMenu(e.y, e.x);
                }.bind(this));

                console.log('y = ', e.y);
                console.log('x = ', e.x);
                e.preventDefault();
            },

            onDrop: function(evt, type) {
                const itemID = evt.dataTransfer.getData('itemID');
                console.log('ItemID = ', itemID);
                this.folderMove = type;
                this.content.splice(itemID,1);
                this.alert = true;
                this.fileToMove = '';
                this.pictToMove = '';
                this.file = false;
                this.thing = true;
                this.folder = false;
                this.showDetails = false;
                this.hideDetails = true;
            },
            dragging: function(evt){
                this.xx = true;
                Vue.nextTick(function() {
                    this.cursor = true;
                    if(this.xx){
                        let t = evt.pageY-65;
                        let l = evt.pageX-247;

                        console.log('tM = ', t);
                        console.log('lM = ', l);

                        this.topM = t + 'px';
                        this.leftM = l + 'px';
                    }
                }.bind(this));
            },
            startDrag: function(evt, idd) {
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                console.log('index = ', index);
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.cursor = true;
                this.fileToMove =  this.content[index].file;
                this.pictToMove = this.getImg(idd);
                this.viewMenu = false;
                evt.dataTransfer.dropEffect = 'move';
                evt.dataTransfer.effectAllowed = 'move';
                evt.dataTransfer.setData('itemID', index);
                let img = new Image();
                img.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=';
                evt.dataTransfer.setDragImage(img, 0, 0);
                console.log('xx = ', this.xx);                
            },
            active: function(idd){
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                return {
                    active: this.aRow[index].row,
                    drop: (this.content[index].type == 'folder') ? true : false,
                    drag: (this.content[index].type == 'file') ? true : false
                };
            },
            clear: function(){
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.file = false;
                this.thing = true;
                this.showDetails = false;
                this.hideDetails = true;
                this.folder = false;
                this.alert = false;
                this.folderMove = '';
                this.mirror = false;
                this.viewMenu = false;
            },
            showing: function(){
                this.showDetails = !this.showDetails;
                this.hideDetails = !this.hideDetails;
                this.showFilter = false;
                this.hideFilter = true;
                this.clicked = false;
                this.viewMenu = false;
                this.mirror = !this.mirror;
            },
            show: function(){
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.file = false;
                this.thing = true;
                this.folder = false;
                this.showFilter = !this.showFilter;
                this.hideFilter = !this.hideFilter;
                this.viewMenu = false;
                this.showDetails = false;
                this.hideDetails = true;
                this.clicked = !this.clicked;
            },
            getImg: function(idd){
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                if(this.content[index].type == 'folder'){
                    return "img/folder.png";
                } else{
                    if(this.content[index].file_type  == 'docx'){
                        return "img/docs.png";
                    } else if(this.content[index].file_type  == 'jpg' || this.content[index].file_type  == 'jpeg'){
                        return "img/jpg.png";
                    }
                }
            },
            getDetails: function(idd){
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.viewMenu = false;
                this.showDetails = true;
                this.hideDetails = false;
                this.mirror = true;
                this.showFilter = false;
                this.hideFilter = true;
                this.clicked = false;
                this.aRow[index].row=true;
                if(this.content[index].type == 'folder'){
                    this.name = this.content[index].file;
                    this.createFolder = this.content[index].file.indexOf("on") != -1 ? this.content[index].file.slice(this.content[index].file.indexOf("on")+3) : '-';
                    this.file = false;
                    this.thing = false;
                    this.folder = true;
                } else{
                    this.name = this.content[index].file;
                    this.type = this.content[index].file_type;
                    this.lastUpdated = this.content[index].last_updated;
                    this.status = this.content[index].file_status;
                    this.size = this.content[index].size;
                    this.file = true;
                    this.thing = false;
                    this.folder = false;
                }
                index = 0;
            }
        }
    }
</script>   