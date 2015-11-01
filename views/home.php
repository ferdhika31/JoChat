<?php $this->output('header');?>

<body onload="getNumberOfOnlineUsers();" onbeforeunload="leaveChat();">
    <div id="onlinecount"></div>

    <h1 class="logo">
        <img alt="Logo" src="<?php echo $this->uri->baseUri;?>assets/img/logo.png" />
    </h1>

    <div id="konten">
        <h1>Selamat Datang di <?php echo $this->uri->baseUri;?></h1>
        <p>Di sini Kamu bisa kenalan dan Chatting sama teman-teman baru secara acak! Ayoo coba, pasti seruu!!</p>
        <div id="intro"><a onclick="startChat();" alt="Mulai chatting!" style="cursor:pointer;">Mulai Chat</a></div>
    </div>

    <div class="chatbox" id="chatbox" style="display:none;"> 

        <div style="top: 90px;" class="logwrapper">
            <div class="logbox" id="logbox">
                <div id="connecting" class="logitem">
                    <div class="statuslog">
                        <code>Menunggu server...</code>
                    </div>
                </div>

                <div id="looking" class="logitem">
                    <div class="statuslog">
                        <code>Menunggu seseorang dulu...</code>
                    </div>
                </div>

                <div id="sayHi" class="logitem">
                    <div class="statuslog">
                        <code>Temen kamu udah ada yang masuk..</code>
                    </div>
                </div>

                <div id="chatDisconnected" class="logitem">
                    <div class="statuslog">
                        <code>Obrolan di tutup.</code>
                    </div>
                </div>

                <div id="startNew" class="logitem">
                    <div>
                        <input value="Mulai obrolan baru" onclick="randomChat();" type="button">
                    </div>
                </div>
            </div>
        </div>
        .
        <div class="controlwrapper">
                <div id="typing" style="display:none;" class="logitem">
                    <div class="statuslog">Teman anda sedang ngetik...
                    </div>
                </div>

                <table class="controltable" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="disconnectbtncell">
                                <div class="disconnectbtnwrapper">
                                    <input disabled="disabled" value="Disconnect" style="cursor:pointer;"
                                           onclick="disconnect();" id="disconnectbtn" class="disconnectbtn"
                                           type="button" />
                                </div>
                            </td>

                            <td class="chatmsgcell">
                                <div class="chatmsgwrapper">
                                    <textarea disabled="enabled"
                                        onblur="stopTyping();"
                                        onfocus="playTitleFlag=false; window.title='Jomblo';"
                                        onkeypress="tryToSend(event);"
                                        id="chatmsg"
                                        rows="3"
                                        cols="80"
                                        class="chatmsg">
                                    </textarea>
                                </div>
                            </td>

                            <td class="sendbthcell">
                                <div class="sendbtnwrapper">
                                    <input disabled="disabled" style="cursor:pointer;"
                                        value="Send" id="sendbtn"
                                        onclick="sendMsg();" class="sendbtn"
                                        type="button">
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

    </div>

    <div id="foot">
        Made in Bandung and powered by <a href="http://dika.web.id/">dika.web.id</a>, Created with <a href="http://panadaframework.com/">Panada</a> version 1.0.0-alfa
    </div>
    
    <a href="https://github.com/ferdhika31/JoChat">
        <img src="<?php echo $this->uri->baseUri; ?>assets/img/forkgithub.png" style="position: absolute; top: 0; right: 0; border: 0;" alt="Fork me on GitHub">
    </a>	
</body>
</html>