<?php
    session_start();
    if ( isset($_SESSION['sid']) and $_SESSION['logged_in_status'] == true  ){
        
        if( @$_GET['logout'] == true ){
            session_destroy();
            header('location:index.php');
        }
    }
    else header('location:index.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&family=Roboto&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="studentdashboard.css">
    <title>Dashboard</title>
</head>

<body>

    <div id=headerdiv>

        <section class="bar" id="first">

            <div class="hd">
                <div class="im"> <img src="images/puc.png" alt="puclogo" id="logo"> </div>
                <div class="im te"> Premier University </div>
            </div>

            <div class="sbar">
                <div class="sidebar">
                    <div class="icon"> <i class="material-icons icn"> dashboard </i></div>
                    <div class="icon writ"> Dashboard </div><br>
                </div>


                <div class="sidebar">
                    <div class="icon"> <i class="material-icons icn"> book </i></div>
                    <div class="icon writ"> My Courses </div><br>
                </div>


                <div class="sidebar">
                    <div class="icon"> <i class="material-icons icn"> inventory </i></div>
                    <div class="icon writ"> Enrollment </div><br>
                </div>


                <div class="sidebar">
                    <div class="icon"> <i class="material-icons icn"> broken_image </i></div>
                    <div class="icon writ"> Evaluation </div><br>
                </div>

                <div class="sidebar">
                    <div class="icon"> <i class="material-icons icn"> credit_card </i></div>
                    <div class="icon writ"> Payment </div><br>
                </div>


                <div class="sidebar">
                    <div class="icon"> <i class="material-icons icn"> grade </i></div>
                    <div class="icon writ"> Marksheets </div><br>
                </div>

                <div class="sidebar">
                    <div class="icon"> <i class="material-icons icn"> summarize </i></div>
                    <div class="icon writ"> Reports </div><br>
                </div>
                <div class="sidebar">
                    <div class="icon"> <i class="material-icons icn"> quiz </i></div>
                    <div class="icon writ"> Exam FAQ </div><br>
                </div>




            </div>

            <div class="cal">
                <div id="chead">
                    <h3>Academic Calender</h3>
                </div>
                <div class="calhead">
                    <p>
                        <i class="material-icons icn"> navigate_before </i>
                        <b> September </September></b>
                        <i class="material-icons icn"> navigate_next </i>

                    </p>
                </div>
                <div class="calhead yr">
                    <label for="year">Year</label><br>
                    <select name="year" id="year">
                        <option value="2021" selected>2021</option>
                        <option value="2020">2020</option>
                        <option value="2020">2019</option>
                        <option value="2020">2018</option>
                        <option value="2020">2017</option>
                        <option value="2020">2016</option>
                        <option value="2020">2015</option>
                        <option value="2020">2014</option>
                        <option value="2020">2013</option>
                        <option value="2020">2012</option>
                        <option value="2020">2011</option>
                        <option value="2020">2010</option>
                    </select>
                </div>

                <table class="calendar">

                    <thead class="thead">
                        <tr>
                            <td class="cal-data">Mon</td>
                            <td class="cal-data">Tue</td>
                            <td class="cal-data">Wed</td>
                            <td class="cal-data">Thu</td>
                            <td class="cal-data">Fri</td>
                            <td class="cal-data">Sat</td>
                            <td class="cal-data">Sun</td>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="cal-data previous">29</td>
                            <td class="cal-data previous">30</td>
                            <td class="cal-data previous">31</td>
                            <td class="cal-data">1</td>
                            <td class="cal-data">2</td>
                            <td class="cal-data">3</td>
                            <td class="cal-data">4</td>
                        </tr>
                        <tr>
                            <td class="cal-data">5</td>
                            <td class="cal-data">6</td>
                            <td class="cal-data">7</td>
                            <td class="cal-data">8</td>
                            <td class="cal-data today">9</td>
                            <td class="cal-data">10</td>
                            <td class="cal-data">11</td>
                        </tr>
                        <tr>
                            <td class="cal-data">12</td>
                            <td class="cal-data">13</td>
                            <td class="cal-data">14</td>
                            <td class="cal-data">15</td>
                            <td class="cal-data">16</td>
                            <td class="cal-data">17</td>
                            <td class="cal-data">18</td>
                        </tr>
                        <tr>
                            <td class="cal-data">19</td>
                            <td class="cal-data">20</td>
                            <td class="cal-data">21</td>
                            <td class="cal-data">22</td>
                            <td class="cal-data">23</td>
                            <td class="cal-data">24</td>
                            <td class="cal-data">25</td>
                        </tr>
                        <tr>
                            <td class="cal-data">26</td>
                            <td class="cal-data">27</td>
                            <td class="cal-data">28</td>
                            <td class="cal-data">29</td>
                            <td class="cal-data">30</td>
                            <td class="cal-data next">1</td>
                            <td class="cal-data next">2</td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <div id="notice-event">
                <div id="not">
                    <h3>Notices & Events </h3>
                </div>
                <div>
                    <div class="statemetn">
                        <div class="state">
                            EMBA Result Published <br>
                            Updated: 1 Sep, 2021 <br>
                            
                        </div>

                        <div class="see-more">
                            see more
                        </div>
                    </div>

                    <div class="statemetn">
                        <div class="state">
                            New Admission <br>
                            Updated: 3 Sep, 2021 <br>
                        </div>

                        <div class="see-more">
                            see more
                        </div>
                    </div>

                    <div class="statemetn">
                        <div class="state">
                            Covid-19 Vaccination <br>
                            Updated: 7 Sep, 2021 <br>
                        </div>

                        <div class="see-more">
                            see more
                        </div>
                    </div>



                </div>
            </div>


        </section>

        <section class="bar" id="second">

            <div id="sbarf">
                <div id="search">
                    <div class="totalsearch">
                        <input type="text" placeholder="Search..." id="serachbar">
                    </div>
                    <div class="totalsearch sicn">
                        <div> <i class="material-icons icnic"> search </i></div>
                    </div>

                </div>
                <div id="logout">
                    <div class="noti-prof">
                        <div class="notify">
                            <i class="material-icons icnic"> announcement</i>
                        </div>
                        <div class="notify">
                            <i class="material-icons icnic"> notifications</i>
                        </div>
                        <div class="notify">
                            <i class="material-icons icnic"> mark_email_unread</i>
                        </div>

                    </div>

                    <div class="noti-prof profile">
                        <a href="studentDashBoard.php?logout=log" class="log" style="text-decoration:none;">Logout</a>
                    </div>



                </div>
            </div>
            <div id="sbars">
                <div id="left">
                    <div id="sub-bar-one">

                        <div class="intro">

                            <?php
                                include("connection.php");
                                $sid = $_SESSION['sid'];
                                $sql = "select * from studnet where S_Id = '$sid'";
                                $qur = mysqli_query($con,$sql);
                                if ( $row = mysqli_fetch_array($qur)){
                            ?>
                                <img src="uploaded_images/<?php echo $row['image']; ?>" alt="student" id="stu-pic">
                           

                        </div>
                        <div class="intro introtext">
                            Hi , <span id="nam"> <?php echo $row['S_name']; ?></span> !
                            <br>
                            <span id="wel">Welcome to PUAIS</span>
                        </div>
                        <div class="intro detail">
                            <div class="padd">
                                <div class="dept">
                                    <i class="material-icons">account_balance</i>
                                </div>
                                <div class="dept just-text">
                                    Computer Science & Engineering
                                </div>
                            </div>
                            <div class="padd">
                                <div class="dept">
                                    <i class="material-icons">perm_identity</i>
                                </div>
                                <div class="dept just-text">
                                    180 35 10 20 1623
                                </div>
                            </div>
                            <div class="padd">
                                <div class="dept">
                                    <i class="material-icons">email</i>
                                </div>
                                <div class="dept just-text">
                                    sajjadhossain.cse35@gmail.com
                                </div>
                            </div>

                        </div>

                    </div>
                    <div id="sub-bar-two">
                        <div class="navbar">
                            <p class="brtwo">Personal Info</p>
                        </div>
                        <div class="navbar">
                            <p class="brtwo">Education</p>

                        </div>
                        <div class="navbar">
                            <p class="brtwo">Skills</p>
                        </div>
                        <div class="navbar">
                            <p class="brtwo">Certifications</p>
                        </div>
                        <div class="navbar">
                            <p class="brtwo">Projects</p>
                        </div>
                    </div>

                    <div id="sub-bar-three">
                        <div class="task-left">
                            <div>
                                <h2 style="text-align: center;">Assignments</h2>
                            </div>
                            <div id="ht"> <a href="sajajd.html" style="text-decoration: none; color: rgb(14, 8, 43);">
                                    See
                                    All </a> </div>

                            <table id="ass">
                                <tr id="heading">
                                    <th class="head-data">Course Name</th>
                                    <th class="head-data">Assigned</th>
                                    <th class="head-data">Deadline</th>
                                    <th class="head-data">status</th>
                                </tr>
                                <tr class="trdata">
                                    <td class="tdata">Database Management Lab </td>
                                    <td class="tdata">30-08-2021</td>
                                    <td class="tdata">09-09-2021</td>
                                    <td class="tdata pend">Pending</td>
                                </tr>
                                <tr class="trdata">
                                    <td class="tdata">Signal System</td>
                                    <td class="tdata">28-08-2021</td>
                                    <td class="tdata">06-09-2021</td>
                                    <td class="tdata submit">Submitted</td>
                                </tr>
                                <tr class="trdata">
                                    <td class="tdata">Engineering Mathematics</td>
                                    <td class="tdata">25-08-2021</td>
                                    <td class="tdata">04-09-2021</td>
                                    <td class="tdata submit">Submitted</td>
                                </tr>
                                <tr class="trdata">
                                    <td class="tdata">Algorithm Analysis</td>
                                    <td class="tdata">23-08-2021</td>
                                    <td class="tdata">02-09-2021</td>
                                    <td class="tdata late-submit">Late Submitted</td>
                                </tr>
                                <tr class="trdata">
                                    <td class="tdata">Algorithm Analysis lab </td>
                                    <td class="tdata">23-08-2021</td>
                                    <td class="tdata">01-09-2021</td>
                                    <td class="tdata submit">Submitted</td>
                                </tr>
                                <tr class="trdata">
                                    <td class="tdata">Industrial Business Management</td>
                                    <td class="tdata">20-08-2021</td>
                                    <td class="tdata">28-08-2021</td>
                                    <td class="tdata missed">Missed</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="sub-bar-four">
                        <div id="examshe">
                            <h2>Exam Schedule</h2>
                        </div>

                        <div id="see"> <a href="sajjad.html" style="text-decoration: none; color: rgb(14, 8, 43);"> See
                                All
                            </a> </div>

                        <table id="exam">
                            <tr id="headingagain">
                                <th class="head-da">Course Name</th>
                                <th class="head-da">Type</th>
                                <th class="head-da">Date</th>
                                <th class="head-da">Time</th>
                            </tr>

                            <tr class="trda">
                                <td class="tda">Engineering Mathematics </td>
                                <td class="tda">Class Test</td>
                                <td class="tda">10-09-2021</td>
                                <td class="tda">11 : 30 </td>
                            </tr>
                            <tr class="trda">
                                <td class="tda">Algorithm Analysis lab </td>
                                <td class="tda">Final</td>
                                <td class="tda">20-10-2021</td>
                                <td class="tda">01 : 30</td>
                            </tr>

                            <tr class="trda">
                                <td class="tda">Engineering Mathematics</td>
                                <td class="tda">Mid Term </td>
                                <td class="tda">14-10-2021</td>
                                <td class="tda">3 : 30 </td>
                            </tr>
                            <tr class="trda">
                                <td class="tda">Algorithm Analysis</td>
                                <td class="tda">Final</td>
                                <td class="tda">02-11-2021</td>
                                <td class="tda">1 : 30</td>
                            </tr>


                            <tr class="trda">
                                <td class="tda">Industrial Business Management</td>
                                <td class="tda">Class Test</td>
                                <td class="tda">30-09-2021</td>
                                <td class="tda">10 : 00</td>
                            </tr>
                            <tr class="trda">
                                <td class="tda">Signal System</td>
                                <td class="tda"> Class Test</td>
                                <td class="tdata">25-09-2021</td>
                                <td class="tda">12 : 00</td>
                            </tr>
                            <tr class="trda">
                                <td class="tda">Database Management System</td>
                                <td class="tda"> Mid Term</td>
                                <td class="tda">09-10-2021</td>
                                <td class="tda">2 : 30</td>
                            </tr>
                        </table>
                    </div>

                    <div id ="sub-bar-five">
                        <div class="five fiveleft">
                                Attendence
                        </div>
                        <div class="five fiveright">
                            Study Materials
                        </div>

                    </div>

                </div>



                <div id="right">

                    <div id="contact-advisor">
                        <h3 style="padding-top: 20px;"> Advisor </h3>
                        <div id="contact">
                            <img src="images/advisor.png" alt="advisor" id="adv">
                        </div>
                        <div>
                            <p>Asma Joshita Trisha<br>
                                Lecturer,DCSE</p>
                        </div>
                        <div id="con"> Contact </div>

                    </div>
                    <div id="Today-class">
                        <div id="cl-head">
                            <h3>Today's Class</h3>
                        </div>


                        <div class="tclass">
                            E. Mathematics <br>
                            09 : 00 - 10 : 30
                        </div>
                        <div class="tclass">
                            Industrial BM <br>
                            11 : 00 - 12 : 00
                        </div>
                        <div class="tclass">
                            Database Lab <br>
                            12 : 00 - 3 : 00
                        </div>
                        <div class="tclass">
                            Signal Systems <br>
                            3 : 00 - 4 : 30
                        </div>




                    </div>

                    <div id="inbox">
                        <div>
                            <p > I  N  B  O  X</p>
                            <i class="material-icons in"> textsms </i>
                            
                        </div>
                       
                    </div>

                    <div id="friend">
                        <h4 style="padding-top:8px;">Friends</h4>

                        <div id="friend-inside">

                            <div class="fst">
                                <div class="image-fri">
                                    <img src="images/fr1.png" alt="friend1" class="fri">
                                </div>
                                <div class="image-fri">
                                    <img src="images/fr2.jpg" alt="friend1" class="fri">
                                </div>
                            </div>


                            <div class="sec">

                                <div class="image-fri">
                                    <img src="images/fr3.jpg" alt="friend1" class="fri">
                                </div>
                                <div class="image-fri">
                                    <img src="images/fr4.jpg" alt="friend1" class="fri">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </section>
    </div>

    <div id="footerdiv">
        Copyright © 2021 Premier University IT. All rights reserved.
    </div>

    <?php
    }
    ?>

    <a href="studentDashBoard.php?logout=log" style = "text-decoration : none ;" >Logout</a>

</body>

</html>