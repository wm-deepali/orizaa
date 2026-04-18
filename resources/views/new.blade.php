@include('teacher.header')

<style>
    body {
        background: #f8f9fa;
    }

    .app-content .content-wrapper .content-body {
        background: #f0f0f0;
        padding: 20px;
        /* border-radius: 10px; */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        position: absolute;
        top: 0px;
        left: 0px;
        right: 0px;
        width: 100%;
        height: 100%;gene
        z-index: 9 !important;
    }

    .liveclass-section {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 15px;
    }

    .card {
        /*border: none;*/
        /*border-radius: 16px;*/
        /*box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);*/
        border: 1px solid #80808029;
        overflow: hidden;
    }

    .top-live-header {
        background: #fdfdfd;
        /*border-radius: 16px;*/
        padding: 15px 25px;
        border-bottom: 1px solid #80808029;
        margin-bottom: 20px;
        /*box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);*/
    }

    .live-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .live-timer {
        font-size: 1.1rem;
        color: #27ae60;
        font-weight: 500;
    }

    .control-btn {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #f1f3f5;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #34495e;
        transition: all 0.3s;
    }

    .control-btn:hover {
        background: #e9ecef;
        transform: scale(1.05);
    }

    .control-btn.active {
        background: #27ae60;
        color: white;
    }

    .self-video {
        position: fixed;
        bottom: 30px;
        left: 30px;
        width: 220px;
        height: 160px;
        z-index: 9999;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        background: white;
        overflow: hidden;
        border: 4px solid #2ecc71;
    }

    .chat-card {
        height: calc(100vh - 180px);
        display: flex;
        flex-direction: column;
    }

    .chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
        background: #f8f9fa;
    }

    .chat-input {
        border-top: 1px solid #e9ecef;
        padding: 15px;
    }

    @media (max-width: 992px) {
        .self-video {
            width: 151px;
            height: 175px;
            bottom: 80px;
            left: 15px;
        }

    }

    /* ────────────────────────────────────────────────
       Students Grid – Modern, Consistent, No Gaps
    ──────────────────────────────────────────────── */
    .students-grid {
    display: grid;
    gap: 16px;
    padding: 8px 0;
}

/* 1 user */
.students-grid.one {
    grid-template-columns: 1fr;
}

/* 2 users */
.students-grid.two {
    grid-template-columns: 1fr 1fr;
}

/* 3 users (2 top, 1 bottom center) */
.students-grid.three {
    grid-template-columns: 1fr 1fr;
}

.students-grid.three .remote-player:nth-child(3) {
    grid-column: 1 / -1;
    max-width: 50%;
    margin: 0 auto;
}

/* 4 users */
.students-grid.four {
    grid-template-columns: 1fr 1fr;
}

/* 5-6 users */
.students-grid.five,
.students-grid.six {
    grid-template-columns: 1fr 1fr 1fr;
}

/* 7-9 users */
.students-grid.seven,
.students-grid.eight,
.students-grid.nine {
    grid-template-columns: 1fr 1fr 1fr;
}

/* fallback (10+) */
.students-grid.more {
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
}


    .remote-player {
        border-radius: 12px;
        overflow: hidden;
        background: #0f0f0f;
        border: 3px solid #2ecc71;
        /* consistent green live border */
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        position: relative;
        aspect-ratio: 16 / 9;
        transition: all 0.25s ease;
    }

    .remote-player:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.22);
        border-color: #27ae60;
    }

    /* Placeholder when video is off / not yet published */
    .remote-player .video-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1e1e1e, #111);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #ddd;
        text-align: center;
    }

    .remote-player .off-circle {
        width: 56px;
        height: 56px;
        background: #34495e;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
        margin-bottom: 14px;
    }

    .remote-player .placeholder-text {
        font-size: 0.95rem;
        opacity: 0.75;
        letter-spacing: 0.5px;
    }

    /* LIVE badge top-left */
    /*.remote-player::before {*/
    /*    content: "LIVE";*/
    /*    position: absolute;*/
    /*    top: 10px;*/
    /*    left: 10px;*/
    /*    background: #e74c3c;*/
    /*    color: white;*/
    /*    font-size: 0.7rem;*/
    /*    font-weight: 600;*/
    /*    padding: 3px 9px;*/
    /*    border-radius: 12px;*/
    /*    z-index: 5;*/
    /*    box-shadow: 0 2px 6px rgba(0,0,0,0.35);*/
    /*}*/

    .end-call-btn {
        color: #d32f2f !important;
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .end-call-btn:hover {
        background: #ffffff !important;
    }

    @media (max-width: 992px) {
        .students-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 14px;
        }
    }

    @media (max-width: 576px) {
        .students-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    .live-controls {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: center;
    }

    .live-controls {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .control-group {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0 8px;
    }

    .control-btn {
        background: rgba(255, 255, 255, 0.18);
        border: none;
        color: #474545;
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
        padding-top: 4px;
    }

    .control-btn:hover {
        background: rgba(255, 255, 255, 0.35);
    }

    .control-btn:active {
        transform: scale(0.96);
    }

    .control-btn.active {
        background: rgba(255, 255, 255, 0.4) !important;
    }

    .control-btn.muted,
    .control-btn.muted i {
        color: #ff6b6b !important;
    }

    .end-call-btn {
        color: #d32f2f !important;
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .end-call-btn:hover {
        background: #ffffff !important;
    }

    .control-label {
        font-size: 10px;
        font-weight: 500;
        margin-top: 2px;
        opacity: 0.9;
        letter-spacing: 0.3px;
    }

    .control-divider {
        width: 1px;
        height: 36px;
        background: #47454526;
        margin: 0 6px;
    }

    /* Optional: when mic/video is off */
    .teacher-audio-toggle.muted i,
    .teacher-video-toggle.muted i {
        color: #ff6b6b;
    }

    .student-live-part {
        min-height: 430px;
        border: 1px solid #80808029 !important;
    }

    /* Professional Chat Styling */
    .chat {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .chat li {
        margin-bottom: 12px;
        padding: 10px 14px;
        border-radius: 18px;
        max-width: 80%;
        word-wrap: break-word;
        font-size: 15px;
        line-height: 1.4;
        position: relative;
    }

    /* Left - Others (Students) */
    .chat .other {
        background: #e5e5ea;
        color: #000;
        border-bottom-left-radius: 4px;
        align-self: flex-start;
        margin-right: auto;
    }

    /* Right - Me (Teacher) */
    .chat .me {
        background: #007aff;
        /* iMessage blue, ya #34c759 green bhi try kar sakte ho */
        color: white;
        border-bottom-right-radius: 4px;
        align-self: flex-end;
        margin-left: auto;
        text-align: right;
    }

    /* Username / Time (optional styling) */
    .chat .sender {
        font-size: 12px;
        opacity: 0.7;
        margin-bottom: 4px;
        display: block;
    }

    /* Chat container ko flex banao taaki left-right sahi align ho */
    .chatBox {
        display: flex;
        flex-direction: column;
    }

    /* Scrollbar thoda clean karo */
    .ticket-max-over {
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
    }

    .ticket-max-over::-webkit-scrollbar {
        width: 6px;
    }

    .ticket-max-over::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }


    @media (min-width: 577px) {
        .mobile-view {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .desktop-view {
            display: none;
        }

        .footer-menu {
            width: 100%;
            height: 60px;
            background: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 0px;

            z-index: 99999;
        }

        .liveclass-section {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 15px;
            height: 82vh;
            position: relative;
            top: 51px;
        }

        .student-live-part {
            min-height: 500px;
            border: 1px solid #80808029 !important;
        }
    }
    
    .no-students {
    grid-column: 1 / -1;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 350px;
}

.waiting-box {
    text-align: center;
    color: #666;
}

.waiting-box i {
    font-size: 50px;
    margin-bottom: 15px;
    color: #2ecc71;
}

.waiting-box h5 {
    font-weight: 600;
    margin-bottom: 5px;
}

.waiting-box p {
    font-size: 14px;
    opacity: 0.7;
}
.video-wrapper {
    width: 100%;
    height: 100%;
}

.student-name {
    position: absolute;
    bottom: 8px;
    left: 8px;
    right: 8px;
    padding: 4px 8px;
    font-size: 13px;
    color: #fff;
    background: rgba(0,0,0,0.6);
    border-radius: 6px;
    text-align: center;
    font-weight: 500;
    z-index: 10;
}
</style>

<div class="app-content content container-fluid">
    <div class="content-wrapper">

        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Live Streaming</h3>
                <div class="breadcrumbs-top">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Live Streaming</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body" style=" z-index: 9 ;">

            <div class="liveclass-section">

                <!-- Top Header -->
                <div class="top-live-header d-flex justify-content-between align-items-center">
                    <div>
                        <span class="live-title desktop-view">Interview</span>
                        <span class="live-timer ms-3" id="live-stream-timer" data-started-at="{{ $call_started_at }}"
                            data-end-at="{{ $end_time_ts }}">
                        </span>
                    </div>

                    <div class="live-controls desktop-view">
                        <!-- Group 1: Share / More features -->
                        <div class="control-group">


                            <button class="control-btn screen-share-btn" title="Share screen">
                                <i class="fas fa-desktop"></i>
                                <span class="control-label">Share</span>
                            </button>

                        </div>

                        <!-- Divider -->
                        <div class="control-divider"></div>

                        <!-- Group 2: Video & Audio -->
                        <div class="control-group">
                            <button class="control-btn teacher-video-toggle" id="video-header-btn"
                                title="Toggle teacher video">
                                <i class="fas fa-video"></i>
                                <span class="control-label">Cam</span>
                            </button>

                            <button class="control-btn teacher-audio-toggle" id="mic-header-btn"
                                title="Toggle Teacher audio">
                                <i class="fas fa-microphone"></i>
                                <span class="control-label">Mic</span>
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="control-divider"></div>

                        <!-- End Call -->
                        <button class="control-btn  leave-call-btn" title="Leave call">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="control-label">Leave</span>
                        </button>
                    </div>


                    <div class="live-controls mobile-view">






                        <!-- End Call -->
                        <button class="control-btn  leave-call-btn" title="Leave call">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="control-label">Leave</span>
                        </button>
                    </div>


                </div>

                <div class="row g-4">

                    <!-- Left: Students Grid -->
                    <div class="col-lg-8">
                        <div class="card  border-0  overflow-hidden student-live-part">
                            <div
                                class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3 px-4">
                                <h5 class="mb-0 fw-semibold">
Participants 
                                    <span id="student-count" class="text-muted small ms-2">(0 online)</span>
                                </h5>
                                <span class="badge bg-success px-3 py-2">LIVE</span>
                            </div>

                            <div class="card-body p-3 p-lg-3">
                                <div id="remote-player-wrapper" class="students-grid">

   <div id="teacher-player-inner" class="students-grid"></div>
<div id="student-player-inner" class="students-grid"></div>

    <!-- 🔶 COMMON PLACEHOLDER -->
    <div id="no-students-placeholder" class="no-students">
        <div class="waiting-box">
            <i class="fas fa-user-clock"></i>
            <h5>Waiting for participants</h5>
            <p>Students and Experts will appear here once they connect</p>
        </div>
    </div>

</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Chat -->
                    <div class="col-lg-4 desktop-view">
                        <div class="card chat-card">
                            <div class="card-header bg-white  d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Chat</h5>
                    <!--            <button type="button" class="btn btn-sm btn-danger toggle-chat-btn">-->
                    <!--    Disable Chat-->
                    <!--</button>-->
                            </div>
                            <div class="chat-body" id="livestream-chat-body">
                                <div class="ticket-max-over">
                                    <ul class="chat chatBox"></ul>
                                </div>
                            </div>
                            <div class="chat-input">
                                <div class="input-group">
                                    <textarea class="form-control message" rows="1"
                                        placeholder="Type your message..."></textarea>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary add-message-btn" type="button"
                                            student_teacher_on_call_live_streaming_id="{{ $student_teacher_on_call_live_streaming->id }}">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-danger validation-err mt-1" id="message-err"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-menu mobile-view">
    <div class="live-controls">
        <!-- Group 1: Share / More features -->


        <!-- Divider -->


        <!-- Group 2: Video & Audio -->
        <div class="control-group">
            <button class="control-btn teacher-video-toggle" id="video-header-btn" title="Toggle teacher video">
                <i class="fas fa-video"></i>
                <span class="control-label">Cam</span>
            </button>

            <button class="control-btn teacher-audio-toggle" id="mic-header-btn" title="Toggle Teacher audio">
                <i class="fas fa-microphone"></i>
                <span class="control-label">Mic</span>
            </button>
            <button class="control-btn screen-share-btn" title="Share screen">
                <i class="fas fa-desktop"></i>
                <span class="control-label">Share</span>
            </button>
            <button class="control-btn  " data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <i class="far fa-comment-dots"></i>
                <span class="control-label">Chat</span>
            </button>
            <button class="control-btn switch-camera-btn" title="Switch Camera">
    <i class="fas fa-sync"></i>
    <span class="control-label">Flip</span>
</button>


            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header ">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Chat</h5>
                    <!--<button type="button" class="btn btn-sm btn-danger toggle-chat-btn" style="margin-left:10px;">-->
                    <!--    Disable Chat-->
                    <!--</button>-->
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <hr>
                <div class="offcanvas-body">
                    <div class="card chat-card">
                        <!--<div class="card-header bg-white">-->
                        <!--    <h5 class="mb-0">Chat</h5>-->
                        <!--</div>-->
                        <div class="chat-body" id="livestream-chat-body">
                            <div class="ticket-max-over">
                                <ul class="chat chatBox"></ul>
                            </div>
                        </div>
                        <div class="chat-input">
                            <div class="input-group">
                                <textarea class="form-control message" rows="1"
                                    placeholder="Type your message..."></textarea>
                                <div class="input-group-append">
                                    <button class="btn btn-primary add-message-btn" type="button"
                                        student_teacher_on_call_live_streaming_id="{{ $student_teacher_on_call_live_streaming->id }}">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="text-danger validation-err mt-1" id="message-err"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->


        <!-- End Call -->

    </div>

</div>
<!-- Floating Self Video -->
<div id="local-player" class="self-video"></div>

<!-- Modal for >16 students -->
<div class="modal fade" id="all-students-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">All Students</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="students-list-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade leftCallModal" id="live-stream-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
</div>

@include('teacher.footer')

<script src="{{ asset('admin/agora-rtm-sdk.js') }}"></script>
<script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>

<script>
    const appId = "{{ env('AGORA_APP_ID') }}"; // Your Agora App ID
    const userId = "teacher_{{ auth()->id() }}_{{ Str::slug(auth()->user()->first_name, '_') }}";
  const channelName = document.querySelectorAll('.add-message-btn')[0].getAttribute('student_teacher_on_call_live_streaming_id');

    let rtm;     // RTM instance
    let channel; // RTM channel
    let CHAT_ENABLED = true;

    let studentCache = {};

async function getStudentName(uid) {
    if (studentCache[uid]) return studentCache[uid];

    try {
        const url = `{{ URL::to('teacher/get-student-name/${uid}') }}`;
        const res = await fetch(url);
        const data = await res.json();

        studentCache[uid] = data.name || 'Student';
        return studentCache[uid];

    } catch (e) {
        return 'Student';
    }
}

function getUserRole(uid) {
    return uid.includes("teacher") ? "teacher" : "student";
}

function formatName(name) {
    return name.replace(/_/g, ' ')
               .replace(/\b\w/g, l => l.toUpperCase());
}

    // Initialize RTM
    async function initRTM() {
        rtm = AgoraRTM.createInstance(appId);

        try {
            //Fetch RTM token from server
            const tokenUrl = `{{ URL::to('teacher/generate-agora-rtm-token/${userId}') }}`;
            const res = await fetch(tokenUrl);
            const data = await res.json();

            // Login to Agora RTM
            await rtm.login({ token: data.token, uid: userId });

            // Create and join channel
            channel = rtm.createChannel(channelName);
            await channel.join();

            // Listen for messages from other users
          channel.on('ChannelMessage', async (message, memberId) => {

    let name = "Student";

    const role = getUserRole(memberId);

    if (role === "teacher") {
        // extract teacher name from uid
        const parts = memberId.split("_").slice(2);
        name = parts.join(" ");
    } else {
        // student API
        name = await getStudentName(memberId);
    }

    name = formatName(name);

    showMessage(name, message.text);
});


            console.log("RTM ready, joined channel:", channelName);

        } catch (err) {
            console.error("RTM error:", err);
        }
    }



function showMessage(user, message) {
    const chatBoxes = document.querySelectorAll(".chatBox");

    const isMe = user === "Me";

    const sideClass = isMe ? "me" : "other";

    const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    const messageHTML = `
        <li class="${sideClass}">
            ${!isMe ? `<span class="sender">${user}</span>` : ''}
            ${message}
            <small style="display:block; font-size:11px; opacity:0.7; margin-top:4px;">${time}</small>
        </li>
    `;

    chatBoxes.forEach(chatBox => {
        chatBox.innerHTML += messageHTML;
        chatBox.scrollTop = chatBox.scrollHeight;
    });
}


    // toggle chat button
   document.querySelectorAll(".toggle-chat-btn").forEach(btn => {
    btn.onclick = async () => {
        CHAT_ENABLED = !CHAT_ENABLED;

        const payload = {
            type: "CHAT_TOGGLE",
            enabled: CHAT_ENABLED
        };

        try {
            await channel.sendMessage({
                text: JSON.stringify(payload)
            });

            const textarea = document.querySelectorAll(".message");
            const sendBtns = document.querySelectorAll(".add-message-btn");

            document.querySelectorAll(".toggle-chat-btn").forEach(b => {
                if (CHAT_ENABLED) {
                    b.innerText = "Disable Chat";
                    b.classList.remove("btn-success");
                    b.classList.add("btn-danger");
                } else {
                    b.innerText = "Enable Chat";
                    b.classList.remove("btn-danger");
                    b.classList.add("btn-success");
                }
            });

            textarea.forEach(t => t.disabled = !CHAT_ENABLED);
            sendBtns.forEach(s => s.disabled = !CHAT_ENABLED);

        } catch (err) {
            console.error("Chat toggle failed:", err);
        }
    };
});
    async function sendMessage() {
        let msg = "";

        document.querySelectorAll(".message").forEach(input => {
            if (input.value.trim() !== "") {
                msg = input.value.trim();
            }
        });

        if (!msg) return;

        try {
            await channel.sendMessage({ text: msg });
            showMessage("Me", msg);

            // clear all inputs
            document.querySelectorAll(".message").forEach(input => {
                input.value = "";
            });

        } catch (err) {
            console.error("Send error:", err);
        }
    }


    document.querySelectorAll(".add-message-btn").forEach(btn => {
        btn.addEventListener("click", sendMessage);
    });

    document.querySelectorAll(".message").forEach(input => {
        input.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                sendMessage();
            }
        });
    });

    // Initialize RTM on page load
    initRTM();


    $(document).ready(function () {
        let whiteboardEnabled = false;
        let screenShareEnabled = false;
        let countdownStarted = false;
         let realtimeTimerInterval = null;

        // Agora Video Call Start
     
        let rtc = {
            client: null,
            localAudioTrack: null,
            localVideoTrack: null,
            screenTrack: null,
            isScreenSharing: false,
            micEnabled: true,
            camEnabled: true,
            remoteTracks: {}
        };

        const options = {
            appId: "{{ env('AGORA_APP_ID') }}",
            channel: document.querySelectorAll('.add-message-btn')[0].getAttribute('student_teacher_on_call_live_streaming_id'),
            uid: "teacher_{{ auth()->id() }}_{{ Str::slug(auth()->user()->first_name, '_') }}",
            screenUid: "teacher_{{ auth()->id() }}_{{ Str::slug(auth()->user()->first_name, '_') }}_screen"
        };

        async function generateToken(uid) {
            const token_url = `{{ URL::to('teacher/generate-agora-token-interview/${options.channel}/${uid}') }}`;
            const token_response = await fetch(token_url);
            const { token } = await token_response.json();
            return token;
        }


     // Timer
     function startTime() {
    const el = document.getElementById('live-stream-timer');
    if (!el) return;

    const startedAt = parseInt(el.dataset.startedAt, 10);
    const endAt = parseInt(el.dataset.endAt, 10);

    if (!startedAt) return;

    let alertShown = false;
    let endTriggered = false; // ✅ prevent multiple triggers

    function pad(v){ return v < 10 ? '0'+v : v; }

    if (realtimeTimerInterval) clearInterval(realtimeTimerInterval);

    realtimeTimerInterval = setInterval(() => {

        const now = Math.floor(Date.now()/1000);

        const elapsed = now - startedAt;
        const m = Math.floor(elapsed / 60);
        const s = elapsed % 60;

        // timer display
        el.textContent = `${pad(m)}:${pad(s)}`;

        if(endAt){
            const remaining = endAt - now;

            // ✅ KEEP YOUR 10 MIN ALERT (UNCHANGED)
            if (remaining <= 600 && remaining > 0 && !alertShown) {
                alertShown = true;

                Swal.fire({
                    icon: 'warning',
                    title: 'Interview Ending Soon',
                    text: 'Only 10 minutes remaining',
                    confirmButtonColor: '#3085d6'
                });
            }

            // ✅ NEW: AUTO END CLASS
            if (remaining <= 0 && !endTriggered) {
                endTriggered = true;

                clearInterval(realtimeTimerInterval);

                Swal.fire({
                    icon: 'info',
                    title: 'Interview Ended',
                    text: 'Interview time is over',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    // trigger leave call button
                    document.querySelectorAll(".leave-call-btn")[0].click();
                });
            }
        }

    }, 1000);
}




          // ────────────────────────────────────────────────
        //  Create consistent card for every student
        // ────────────────────────────────────────────────
        function createOrGetPlayerContainer(uid) {
            let container = document.getElementById(`remote-player-${uid}`);
            if (!container) {
                container = document.createElement('div');
                container.id = `remote-player-${uid}`;
                container.className = 'remote-player';
                
container.innerHTML = `
    <div class="video-wrapper"></div>

    <div class="video-placeholder">
        <div class="off-circle">S</div>
        <div class="placeholder-text">Video Off</div>
    </div>

    <div class="student-name">Student</div>

    <!-- 🔥 NEW: Controls -->
   <div style="position:absolute; top:8px; right:8px; z-index:20; display:flex; gap:6px;">

    <!-- AUDIO -->
    <button class="control-btn student-audio-btn" onclick="toggleStudentAudio('${uid}', this)">
        <i class="fas fa-microphone"></i>
    </button>

    <!-- VIDEO -->
    <button class="control-btn student-video-btn" onclick="toggleStudentVideo('${uid}', this)">
        <i class="fas fa-video"></i>
    </button>

</div>
`;
                const role = getUserRole(uid);

if (role === "teacher") {
    document.getElementById('teacher-player-inner').appendChild(container);
} else {
    document.getElementById('student-player-inner').appendChild(container);
}
            }
            return container;
        }


            async function startCall() {
            rtc.client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

            // When a user joins → create placeholder card immediately
            rtc.client.on("user-joined", (user) => {
                createOrGetPlayerContainer(user.uid);
                updateStudentCount();
            });

            rtc.client.on("user-published", async (user, mediaType) => {
                rtc.remoteTracks[user.uid] = user;
                await rtc.client.subscribe(user, mediaType);

                const container = createOrGetPlayerContainer(user.uid);

const role = getUserRole(user.uid);

let name = "Student";

if (role === "teacher") {
    const parts = user.uid.split("_").slice(2);
    name = parts.join(" ");
} else {
    name = await getStudentName(user.uid);
}

name = formatName(name);

// set name
const nameEl = container.querySelector('.student-name');
if (nameEl) {
    nameEl.innerText = name;
}


// ✅ Update placeholder (initials)
const placeholder = container.querySelector('.video-placeholder');
if (placeholder) {
    placeholder.innerHTML = `
        <div class="off-circle">${name.charAt(0).toUpperCase()}</div>
        <div class="placeholder-text">${name}</div>
    `;
}

                if (mediaType === "video" && user.videoTrack) {
                    // Remove placeholder → play real video
                    const placeholder = container.querySelector('.video-placeholder');
                   if (placeholder) placeholder.style.display = "none";
                  const videoDiv = container.querySelector('.video-wrapper');
user.videoTrack.play(videoDiv);
                }

                if (mediaType === "audio" && user.audioTrack) {
                    user.audioTrack.play();
                }

                updateStudentCount();
            });

            rtc.client.on("user-left", (user) => {
                const el = document.getElementById("remote-player-" + user.uid);
                if (el) el.remove();
                updateStudentCount();
            });

         function updateStudentCount() {
    const users = document.querySelectorAll('.remote-player');

    let studentCount = 0;
    let teacherCount = 0;

    users.forEach(el => {
        const uid = el.id.replace("remote-player-", "");

        if (uid.includes("teacher")) {
            teacherCount++;
        } else {
            studentCount++;
        }
    });

  document.getElementById("student-count").textContent =
`(${studentCount} student${studentCount !== 1 ? 's' : ''}, ${teacherCount} expert${teacherCount !== 1 ? 's' : ''})`;


    const placeholder = document.getElementById("no-students-placeholder");

    if (studentCount === 0 && teacherCount === 0) {

    const placeholder = document.getElementById("no-students-placeholder");

    if (!placeholder) {
        const wrapper = document.getElementById("remote-player-wrapper");

        const div = document.createElement("div");
        div.id = "no-students-placeholder";
        div.className = "no-students";

        div.innerHTML = `
            <div class="waiting-box">
                <i class="fas fa-user-clock"></i>
                <h5>Waiting for participants</h5>
                <p>Participants will appear here once they connect</p>
            </div>
        `;

        wrapper.appendChild(div);
    }

} else {
    const placeholder = document.getElementById("no-students-placeholder");
    if (placeholder) placeholder.remove();
}
    
    function updateGridLayout() {
    const wrapper = document.getElementById("remote-player-wrapper");
    const users = wrapper.querySelectorAll('.remote-player');

    const count = users.length;

    // reset classes
    wrapper.classList.remove(
        "one","two","three","four",
        "five","six","seven","eight","nine","more"
    );

    if (count === 1) wrapper.classList.add("one");
    else if (count === 2) wrapper.classList.add("two");
    else if (count === 3) wrapper.classList.add("three");
    else if (count === 4) wrapper.classList.add("four");
    else if (count === 5) wrapper.classList.add("five");
    else if (count === 6) wrapper.classList.add("six");
    else if (count === 7) wrapper.classList.add("seven");
    else if (count === 8) wrapper.classList.add("eight");
    else if (count === 9) wrapper.classList.add("nine");
    else wrapper.classList.add("more");
}

updateGridLayout();

}

            const token = await generateToken(options.uid);
            await rtc.client.join(options.appId, options.channel, token, options.uid);

            rtc.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
            rtc.localVideoTrack = await AgoraRTC.createCameraVideoTrack();
            await rtc.client.publish([rtc.localAudioTrack, rtc.localVideoTrack]);
            rtc.localVideoTrack.play("local-player");
        }

        // Mic / Video toggles

        // VIDEO TOGGLE (all buttons)
        document.querySelectorAll(".teacher-video-toggle").forEach(btn => {
            btn.onclick = async () => {
                rtc.camEnabled = !rtc.camEnabled;
                await rtc.localVideoTrack.setEnabled(rtc.camEnabled);

                // 🔥 update ALL video buttons
                document.querySelectorAll(".teacher-video-toggle").forEach(b => {
                    const icon = b.querySelector("i");
                    icon.className = rtc.camEnabled ? "fas fa-video" : "fas fa-video-slash";

                    b.classList.toggle("muted", !rtc.camEnabled);
                });
            };
        });

        // AUDIO TOGGLE (all buttons)
        document.querySelectorAll(".teacher-audio-toggle").forEach(btn => {
            btn.onclick = async () => {
                rtc.micEnabled = !rtc.micEnabled;
                await rtc.localAudioTrack.setEnabled(rtc.micEnabled);

                // 🔥 update ALL audio buttons
                document.querySelectorAll(".teacher-audio-toggle").forEach(b => {
                    const icon = b.querySelector("i");
                    icon.className = rtc.micEnabled ? "fas fa-microphone" : "fas fa-microphone-slash";

                    b.classList.toggle("muted", !rtc.micEnabled);
                });
            };
        });



        async function join_call() {
            console.log('join call uid', options.uid);
            const token = await generateToken(options.uid);
            options.token = token;
            await rtc.client.join(options.appId, options.channel, token, options.uid);
            rtc.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
            rtc.localVideoTrack = await AgoraRTC.createCameraVideoTrack();
            await rtc.client.publish([rtc.localAudioTrack, rtc.localVideoTrack]);
            const localPlayerContainer = document.getElementById('local-player');
            rtc.localVideoTrack.play(localPlayerContainer);
        }

        join_call();
        startCall();



      // Screen share (kept original)
   
       document.querySelectorAll(".screen-share-btn").forEach(btn => {
    btn.onclick = async () => {

        if (rtc.isScreenSharing) return;

        try {
            rtc.isScreenSharing = true;

    // ✅ CALL API HERE (START)
            await sendScreenEvent("start");
            
            const screenTrack = await AgoraRTC.createScreenVideoTrack(
                { encoderConfig: "1080p_1" },
                "auto"
            );

            rtc.screenTrack = Array.isArray(screenTrack) ? screenTrack[0] : screenTrack;

            // ❌ remove camera
            await rtc.client.unpublish(rtc.localVideoTrack);

            // ✅ publish screen
            await rtc.client.publish(rtc.screenTrack);

            // ✅ hide self video
            document.getElementById("local-player").style.display = "none";

            // ✅ create screen container
            const container = document.createElement("div");
            container.className = "remote-player";
            container.id = "screen-share-container";

            container.innerHTML = `
                <div class="video-wrapper" id="screen-share-player"></div>
                <div class="student-name">You are sharing screen</div>
            `;

            document.getElementById("teacher-player-inner").prepend(container);

            // ▶️ play screen
            rtc.screenTrack.play("screen-share-player");

            // auto stop
            rtc.screenTrack.on("track-ended", stopScreenShare);

        } catch (err) {
            rtc.isScreenSharing = false;
            console.error("Screen share failed:", err);
        }
    };
});


       async function stopScreenShare() {
    if (!rtc.screenTrack) return;
    
      await sendScreenEvent("stop");

    await rtc.client.unpublish(rtc.screenTrack);

    rtc.screenTrack.stop();
    rtc.screenTrack.close();
    rtc.screenTrack = null;
    rtc.isScreenSharing = false;

    // 🧹 remove screen UI
    const screenContainer = document.getElementById("screen-share-container");
    if (screenContainer) screenContainer.remove();

    // ✅ show self video back
    document.getElementById("local-player").style.display = "block";

    await resetCameraTrack();
}

        async function sendScreenEvent(type) {
    try {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const sessionId = document.querySelectorAll('.add-message-btn')[0]
            .getAttribute('student_teacher_on_call_live_streaming_id');

        await fetch("{{ URL::to('teacher/broadcast-screen-event') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token
            },
            body: JSON.stringify({
                session_id: sessionId,
                type: type // start / stop
            })
        });

    } catch (err) {
        console.error("Screen event API failed:", err);
    }
}

        async function resetCameraTrack() {
            if (rtc.localVideoTrack) {
                try { await rtc.client.unpublish(rtc.localVideoTrack); } catch (e) { }
                rtc.localVideoTrack.stop();
                rtc.localVideoTrack.close();
                rtc.localVideoTrack = null;
            }
            rtc.localVideoTrack = await AgoraRTC.createCameraVideoTrack();
            await rtc.client.publish(rtc.localVideoTrack);
            rtc.localVideoTrack.play("local-player");
        }

        document.querySelectorAll(".leave-call-btn").forEach(btn => {
            btn.onclick = async () => {
                if (rtc.localAudioTrack) rtc.localAudioTrack.close();
                if (rtc.localVideoTrack) rtc.localVideoTrack.close();
                if (rtc.screenTrack) rtc.screenTrack.close();
                await rtc.client.leave();
                end_call();
            };
        });


  // ────────────────────────────────────────────────
        //  >16 students → +More card (kept original logic)
        // ────────────────────────────────────────────────
        let moreCard = null;
        const observer = new MutationObserver(() => {
            const wrapper = document.getElementById("remote-player-wrapper");
            const all = wrapper.querySelectorAll('.remote-player');
            const visible = 16;

            if (moreCard) moreCard.remove();
            moreCard = null;

            if (all.length <= visible) {
                all.forEach(c => c.style.display = "block");
                return;
            }

            for (let i = visible; i < all.length; i++) {
                all[i].style.display = "none";
            }

            moreCard = document.createElement("div");
            moreCard.className = "remote-player";
            moreCard.style.border = "3px solid #3498db";
            moreCard.style.background = "#2c3e50";
            moreCard.style.color = "white";
            moreCard.style.display = "flex";
            moreCard.style.alignItems = "center";
            moreCard.style.justifyContent = "center";
            moreCard.style.flexDirection = "column";
            moreCard.style.cursor = "pointer";
            moreCard.innerHTML = `
            <div style="font-size:2.8rem; font-weight:700;">+${all.length - visible}</div>
            <div style="font-size:1rem; margin-top:8px;">More Students</div>
        `;
            moreCard.onclick = () => {
                let html = '<div class="list-group">';
                all.forEach(card => {
                    const uid = card.id.replace("remote-player-", "");
                    html += `<div class="list-group-item">Student ${uid} <span class="badge badge-success float-right">Live</span></div>`;
                });
                html += '</div>';
                document.getElementById("students-list-body").innerHTML = html;
                $('#all-students-modal').modal('show');
            };
            wrapper.appendChild(moreCard);
        });

        observer.observe(document.getElementById("remote-player-wrapper"), { childList: true });


        async function end_call() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = `{{ URL::to('teacher/end-video-interview/${options.channel}') }}`;
            const response = await fetch(url, {
                headers: {
                    "Content-type": "application/json",
                    "X-CSRF-TOKEN": token,
                },
                method: 'POST',
                credentials: "same-origin",
            });
            const responseData = await response.json();
            if (responseData.success) {
                $('#live-stream-modal').html(`<div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-body">
                        <div class="left-close">    
                        </div>
                        <div class="left-call-main">
                            <div class="left-call-head">
                                <h3>You left the call</h3>
                            </div>
                            <div class="left-call-ratings">
                                <label>How was the quality of call?</label>
                                <div class="star-rating__stars">
                                    <input class="star-rating__input call_rating" type="radio" name="rating" value="1" id="rating-1" />
                                    <label class="star-rating__label" for="rating-1" aria-label="One"></label>
                                    <input class="star-rating__input call_rating" type="radio" name="rating" value="2" id="rating-2" />
                                    <label class="star-rating__label" for="rating-2" aria-label="Two"></label>
                                    <input class="star-rating__input call_rating" type="radio" name="rating" value="3" id="rating-3" />
                                    <label class="star-rating__label" for="rating-3" aria-label="Three"></label>
                                    <input class="star-rating__input call_rating" type="radio" name="rating" value="4" id="rating-4" />
                                    <label class="star-rating__label" for="rating-4" aria-label="Four"></label>
                                    <input class="star-rating__input call_rating" type="radio" name="rating" value="5" id="rating-5" checked/>
                                    <label class="star-rating__label" for="rating-5" aria-label="Five"></label>
                                    <div class="star-rating__focus"></div>
                                </div>

                                <div class="star-rating__feedback">
                                    <textarea rows="3" cols="6" placeholder="Write your feedback here..." id="call_feedback"></textarea>
                                </div>
                            </div>
                            <div class="left-call-actions">
                                <button type="button" class="return-home" onclick="submitFeedback()">Submit Feedback</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>`);
                $('#live-stream-modal').modal('show');
            } else {

            }
        }


    });

    async function submitFeedback() {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
       const live_stream_id = document.querySelectorAll('.add-message-btn')[0].getAttribute('student_teacher_on_call_live_streaming_id');
        const url = `{{ URL::to('teacher/submit-interview-feedback/${live_stream_id}') }}`;
        const response = await fetch(url, {
            headers: {
                "Content-type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            method: 'POST',
            credentials: "same-origin",
            body: JSON.stringify({
                "rating": $('.call_rating:checked').val(),
                "review": $('#call_feedback').val(),
            })
        });
        const responseData = await response.json();
        const redirect_url = `{{ URL::to('teacher/manage-interview-scheduled') }}`;
        window.location.replace(redirect_url);
    }

</script>