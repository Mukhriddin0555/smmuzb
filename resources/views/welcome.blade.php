<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }
        body {
            width: 100%;
            height: 370vh;
        }
        .container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            transition: 1s;
        }
        .menu {
            width: 100%;
            height: 10vh;
            background: linear-gradient(rgb(0,0,0,0.3), rgb(0,0,0,0.5));
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        .main-menu {
            position: relative;
            width: 150px;
            height: 40px;
            background: linear-gradient(rgb(0,0,0,0.2),rgb(0,0,0,0.3));
            border-radius: 5px;
            margin: 20px;
            color: white;
            font-family: sans-serif;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
            cursor: pointer;
            transition: 0.7s all;
        }
        .advertisement {
            width: 100%;
            height: 45vh;
            display: flex;
            background-image: url( {{ asset('storage/images/modern-geometrical-background-with-white-triangles.jpg')}} );
            justify-content: center;
            background-position: center;
            background-size: cover;
        }
        
        .pictures {
            width: 100%;
            height: 140vh;
            background-image: url({{ asset('storage/images/picture-background.png')}});
            background-position: center;
            background-size: cover;
        }
        .numbers {
            width: 100%;
            height: 20vh;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .about-office {
            width: 100%;
            height: 120vh;
            display: flex;
            background-color: rgb(44, 44, 44);
            flex-direction: column;
        }
        .email {
            width: 100%;
            height: 45vh;
            background-color: rgb(31, 30, 30);
            display: flex;
        }
        h2 {
            font-family: sans-serif;
            letter-spacing: 0.6px;
            margin-left: 150px;
            color: rgb(165, 165, 165);
        }
        .icons {
            width: 45%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }
        .picture-line {
            width: 100%;
            height: 25%;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }
        .image {
            width: 20%;
            height: 85%;
        }
        .picture {
            width: 100%;
            height: 85%;
            background-image: url({{ asset('storage/images/img-13.jpg')}});
            background-position: center;
            background-size: cover;
        }
        .views {
            width: 100%;
            height: 15%;
            display: flex;
        }
        .day {
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
        }
        .view {
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        a {
            font-family: sans-serif;
            color: rgb(177, 177, 177);
            font-size: 17px;
        }
        .num-btn {
            width: 180px;
            height: 50px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
        .little-num {
            width: 50px;
            height: 50px;
            border-radius: 20%;
            border: none;
            margin: 20px;
            cursor: pointer;
            font-size: 18px;
        }
        .nums {
            width: 52%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .top-logo {
            width: 100%;
            height: 32%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }
        .text {
            width: 100%;
            height: 15%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .bottom-contact {
            width: 100%;
            height: 53%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
        }
        .office-logo {
            width: 180px;
            height: 180px;
            background-image: url({{ asset('storage/images/zuhro.jpg')}});
            background-position: center;
            background-size: cover;
        }
        h1 {
            color: white;
            font-family: sans-serif;
            font-size: 36px;
            letter-spacing: 1px;
        }
        #ul {
            color: white;
            font-family: sans-serif;
            font-size: 20px;
        }
        li {
            line-height: 30px;
        }
        .reach {
            font-size: 32px;
            font-weight: 550;
            color: white;
        }
        .email-input {
            width: 45%;
            height: 45px;
            border-radius: 8px;
            border: none;
            cursor: text;
            outline: none;
            padding: 0 0.8vw;
            color: rgb(57, 57, 57);
            letter-spacing: 0.8px;
        }
        .email-massage {
            width: 45%;
            height: 120px;
            border-radius: 8px;
            border: none;
            cursor: text;
            outline: none;
            padding: 0 0.8vw;
            color: rgb(57, 57, 57);
            letter-spacing: 0.8px;
        }
        #send {
            width: 40%;
            height: 45px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .last-frame {
            width: 25%;
            height: 90%;
            display: flex;
            flex-direction: column;
            margin-left: 100px;
        }
        .navigation {
            width: 15%;
            height: 90%;
        }
        .contacts {
            width: 15%;
            height: 90%;
        }
        h6 {
            font-family: sans-serif;
            font-size: 22px;
            color: white;
            margin-top: 60px;
        }
        p {
            color: white;
            font-family: sans-serif;
            font-size: 14px;
        }
        a {
            text-decoration: none;
        }
        .menu-search {
            width: 180px;
            height: 40px;
            border-radius: 5px;
            outline: none;
            margin-left: 100px;
            border: 1px solid black;
            padding: 0 0.5vw;
        }
        .menu-button {
            width: 30px;
            height: 30px;
            background-image: url({{ asset('storage/images/Untitled-1.png')}});
            background-position: center;
            background-size: cover;
            margin-left: 5px;
        }
        .s-menu {
            margin-left: 285px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu">
            @if (Route::has('login'))
                    @auth
                        <a href="{{ route('admin') }}"><div class="main-menu s-menu">Асосий</div></a>
                    @else
                        <a href="{{ route('login') }}"><div class="main-menu s-menu">Кириш</div></a>
                    @endauth
            @endif
            <a href="#shop"><div class="main-menu f-menu">Shop</div></a>
            <a href="#tmenu" id="first_a"><div class="main-menu t-menu">About Office </div></a>
            <a href="#contact"><div class="main-menu fourth-menu">Contact</div></a>
            <input type="text" placeholder="search" class="menu-search">
            <div class="menu-button"></div>
        </div>
        <div class="advertisement" id="advertisement"></div>
        <div class="pictures" id="shop">
            <div class="picture-line">
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
            </div>
            <div class="picture-line">
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
            </div>
            <div class="picture-line">
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
            </div>
            <div class="picture-line">
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
                <div class="image">
                    <div class="picture"></div>
                    <div class="views">
                        <div class="day"><a>9 iyun 2022</a></div>
                        <div class="view"><a>0 views</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="numbers">
            <button class="before num-btn"><h3>before</h3></button>
            <div class="nums">
                <button class="little-num one">1</button>
                <button class="little-num two">2</button>
                <button class="little-num three">3</button>
            </div>
            <button class="after num-btn"><h3>after</h3></button>
        </div>
        <div class="about-office" id="tmenu">
            <div class="top-logo">
                <div class="office-logo"></div>
                <h1>Office Contact</h1>
            </div>
            <div class="text">
                <ul id="ul">
                    <li>Have questions about Office?</li>
                    <li>Need a custom version of Office with specific features, designs, or integrations?</li>
                    <li>Have an idea for an immersive, multi-user experience that lives on the web?</li>
                </ul>
            </div>
            
            <form action="{{route('usersendcontact')}}" method="POST" class="bottom-contact">
                @csrf
                <a class="reach">Reach Out</a>
                <input type="text" name="name" class="email-input" placeholder="Your name">
                <input type="text" name="number" class="email-input" placeholder="Your number">
                <input type="text" name="email" class="email-input" placeholder="Email address">
                <textarea type="text" name="message" class="email-massage" placeholder="Message"></textarea>
                <button id="send" type="submit">Send Message</button>
            </form>
        
        </div>
        <div class="email" id="contact">
            <div class="last-frame">
                <h6>ABOUT FRAME</h6><br>
                <p>Frame is a beta product from Virbela. Frame makes <br> it easy to communicate and collaborate in 3D <br> environments, right from the web browser.</p><br>
                <p>Here is our Privacy Policy and Terms of Service.</p>
            </div>
            <div class="navigation">
                <h6>NAVIGATION</h6><br>
                <p>Frame</p><br>
                <p>Learning Center</p><br>
                <p>Blog</p><br>
                <p>Contact</p>
            </div>
            <div class="contacts">
                <h6>CONTACTS</h6><br>
                <p>hello@framevr.io</p><br>
                <p>@frame_vr</p><br>
                <p>Frame on Facebook</p>
            </div>
        </div>
    </div>
</body>
</html>