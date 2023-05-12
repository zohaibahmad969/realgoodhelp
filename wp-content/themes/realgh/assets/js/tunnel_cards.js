/*
 * ---------------------------save lesson from new card design starts--------------------------------
 */
if (document.querySelector('.current_save_profile')) {
    saveLessonInit()
}

function saveLessonInit() {
    const btn = document.querySelector('.current_save_profile')

    // isLessonSaved(btn)

    btn.addEventListener('click', () => saveLesson(btn))
}

function saveLesson(btn, save_action) {

    btn.classList.toggle('saved')

    if (save_action === "only_save_no_unsave") {
        // check if post is already saved then return otherwise save
        if (!btn.classList.contains('saved')) {
            return false
        }
    }


    const save_icon = rlghData.themePath + '/assets/img/category-page-icons/save-btn.svg'
    const save_cancel_icon = rlghData.themePath + '/assets/img/category-page-icons/save-cancel.png'

    if (btn.classList.contains('saved')) {
        let row = window.localStorage.getItem('saved_lessons')
        const lessonsId = row ? JSON.parse(row) : []
        lessonsId.push(btn.dataset.lesson)
        window.localStorage.setItem('saved_lessons', JSON.stringify(lessonsId))

        document.getElementById('current_save_profile_btn').setAttribute('src', save_cancel_icon)

        document.getElementsByClassName('cp-action-popup')[0].style.display = 'block'
        window.setTimeout(function () {
            document.getElementsByClassName('cp-action-popup')[0].style.display = 'none'
        }, 4000)

        // save the cards postid and post tile in array. this will be used to show reminder screen at the end of cards
        let postdetailsObj = { id: $('.que-list-box.current-que').attr('data-id'), title: $('.que-list-box.current-que').find('.question h2').text() };
        yes_answer_arr.push(postdetailsObj);

    } else {
        let row = window.localStorage.getItem('saved_lessons')
        const lessonsId = JSON.parse(row)

        const idx = lessonsId.findIndex(themeId => themeId == btn.dataset.lesson)
        lessonsId.splice(idx, 1)

        window.localStorage.setItem('saved_lessons', JSON.stringify(lessonsId))

        document.getElementById('current_save_profile_btn').setAttribute('src', save_icon)
    }

    // Save Data to database
    if ($("body").hasClass('logged-in')) {
        saveLocalStorageDataToDB('saved_lessons')
    }
}
/*
 * ---------------------------save lesson from new card design ends--------------------------------
 */

/*
 * ---------------------------Tunnel Form functionality starts--------------------------------
 */

// complete cards again click function on category page
jQuery(document).on('click', '.js_clear_saved_lessons', function (e) {
    e.preventDefault()
    window.localStorage.setItem('lessons_answer', '')
    // Save Data to database
    if ($("body").hasClass('logged-in')) {
        saveLocalStorageDataToDB('lessons_answer')
    }
    location.reload()
})

if (document.querySelector('.show-tunnel-question-radio-blocks-btn')) {
    const show_old_quests_btn = document.querySelector(
        '.show-tunnel-question-radio-blocks-btn'
    )
    const old_questions = document.querySelector(
        '.tunnel-form-questions-radio-blocks'
    )
    show_old_quests_btn.addEventListener('click', function () {
        show_old_quests_btn.classList.toggle('shown')
        old_questions.classList.toggle('dis-block')
    })
}

if (document.querySelector('.tunnel__form')) {
    const formf2 = document.querySelector('.tunnel__form')
    const questionsf2 = formf2.querySelectorAll('.form-question__variants')
    questionsf2.forEach(block => {
        if (block.querySelector('.radio')) totalchk++
    })
}

if (
    document.querySelector('.tunnel__form') &&
    document.querySelector('.tunnel__button2')
) {
    const formf = document.querySelector('.tunnel__form')
    const btnf = formf.querySelector('.tunnel__button2')
    const questionsf = formf.querySelectorAll('.form-question__variants')

    let isBtnDisabledf = checkTunnelForm(questionsf)
    btnf.disabled = isBtnDisabledf
    if (!btnf.disabled) {
        document.getElementById('tunnel__button2').style.display = 'none'
    }

    /*if(totalact>0 && totalchk>0 && totalact==totalchk){*/
    if (!btnf.disabled) {
        document.getElementById('que_list_sec').style.display = 'none'
        document.getElementById('finished_info').style.display = ''
        document.getElementById('tunnel__button2').style.display = 'none'

        btnf.addEventListener('click', () => {
            saveLessonsAnswer2(formf)
            addSuggestions2(formf)
        })
    } else {
        document.getElementById('que_list_sec').style.display = ''
        document.getElementById('finished_info').style.display = 'none'
        document.getElementById('tunnel__button2').style.display = 'none'
    }

    if (document.querySelector('.que-list-box')) {
        var cardList = document.querySelectorAll('.que-list-box')
        if (cardList.length == 1) {
            cardlist_noneed_html =
                '<div class="que-list-box width-33 show_cards noneed" style="order:1"><div class="que-list-inner"><div class="que-img-que"></div></div></div><div class="que-list-box width-33 show_cards noneed" style="order:3"><div class="que-list-inner"><div class="que-img-que"></div></div></div>'
            document.getElementById('que-list-main').innerHTML += cardlist_noneed_html
        } else if (cardList.length == 2) {
            cardlist_noneed_html =
                '<div class="que-list-box width-33 show_cards noneed" style="order:3"><div class="que-list-inner"><div class="que-img-que"></div></div></div>'
            document.getElementById('que-list-main').innerHTML += cardlist_noneed_html
        }
    }
}

/*
 * ---------------------------Tunnel Form functionality ends--------------------------------
 */

/*
 * ---------------------------Card swipe animation starts--------------------------------
 */

var moveX = 0
var moveY = 0
var totalchk = 0
var totalact = 0
var back_htmlque_html = new Array()
var current = document.getElementsByClassName('current-que')
current = current[0]
var frame = document.getElementsByClassName('que-list-main')
var cp_other_screen_visible = 'false';
var yes_answer_arr = new Array();

if (typeof current !== 'undefined') {
    let likeText = current.children[0]
    let startX = 0,
        startY = 0,
        moveX = 0,
        moveY = 0
    initCard(current)
}

current_que()

function current_que() {
    if (document.querySelector('.que-img')) {
        Array.from(document.querySelectorAll('.que-img')).forEach(e => {
            e.removeEventListener('click', queimage)
        })
        Array.from(document.querySelectorAll('.que-img')).forEach(e => {
            e.dataset.datayoutube = e.getAttribute('datayoutube')
            e.dataset.dataid = e.getAttribute('dataid')
            var dataheight = e.clientHeight
            document.getElementById(
                'que-video-player-' + e.dataset.dataid
            ).style.height = dataheight + 'px'
            e.addEventListener('click', queimage)
        })
    }

    if (document.querySelector('.play-btn')) {
        Array.from(document.querySelectorAll('.play-btn')).forEach(e => {
            e.removeEventListener('click', queplay)
        })
        Array.from(document.querySelectorAll('.play-btn')).forEach(e => {
            e.dataset.datayoutube = e.getAttribute('datayoutube')
            e.dataset.dataid = e.getAttribute('dataid')
            e.addEventListener('click', queplay)
        })
    }

    if (document.querySelector('.questionclick')) {
        Array.from(document.querySelectorAll('.questionclick')).forEach(e => {
            e.removeEventListener('click', quequestion)
        })
        Array.from(document.querySelectorAll('.questionclick')).forEach(e => {
            e.dataset.dataid = e.getAttribute('dataid')
            e.dataset.datatitle = e.getAttribute('datatitle')
            e.dataset.datatext = e.getAttribute('datatext')
            e.dataset.datayoutube = e.getAttribute('datayoutube')
            e.addEventListener('click', quequestion)
        })
    }

    if (document.querySelector('.que-video-close')) {
        Array.from(document.querySelectorAll('.que-video-close')).forEach(e => {
            e.removeEventListener('click', queclose)
        })
        Array.from(document.querySelectorAll('.que-video-close')).forEach(e => {
            e.dataset.dataid = e.getAttribute('dataid')
            e.addEventListener('click', queclose)
        })
    }

    if (document.querySelector('.close-video-popup-new')) {
        Array.from(document.querySelectorAll('.close-video-popup-new')).forEach(
            e => {
                e.removeEventListener('click', moreinfoclosevideopopup)
            }
        )
        Array.from(document.querySelectorAll('.close-video-popup-new')).forEach(
            e => {
                e.addEventListener('click', moreinfoclosevideopopup)
            }
        )
    }

    if (document.querySelector('.first_profile_close')) {
        Array.from(document.querySelectorAll('.first_profile_close')).forEach(e => {
            e.removeEventListener('click', firstprofileclose)
        })
        Array.from(document.querySelectorAll('.first_profile_close')).forEach(e => {
            e.addEventListener('click', firstprofileclose)
        })
    }

    if (document.querySelector('.finished_profile_close')) {
        Array.from(document.querySelectorAll('.finished_profile_close')).forEach(
            e => {
                e.removeEventListener('click', finishedprofileclose)
            }
        )
        Array.from(document.querySelectorAll('.finished_profile_close')).forEach(
            e => {
                e.addEventListener('click', finishedprofileclose)
            }
        )
    }
}

function initCard(card) {
    var current = document.getElementsByClassName('current-que')
    current = current[0]
    card.addEventListener('pointerdown', onPointerDown)

    var dataid = current.getAttribute('data-id')
    document
        .getElementById('current_save_profile')
        .setAttribute('data-lesson', dataid)
    document
        .getElementById('current_back_btn')
        .setAttribute('data-lesson', dataid)

    if (htmlque_first_post_id == dataid) {
        document.getElementById('current_back_btn').style.opacity = '0.5'
        document.getElementById('current_back_btn').style.cursor = 'inherit'
    } else {
        document.getElementById('current_back_btn').style.opacity = '1'
        document.getElementById('current_back_btn').style.cursor = 'pointer'
    }

    const btn = document.querySelector('.current_save_profile')
    const row = window.localStorage.getItem('saved_lessons')
    const lessonsId = row ? JSON.parse(row) : []
    const save_icon =
        rlghData.themePath + '/assets/img/category-page-icons/save-btn.svg'
    const save_cancel_icon =
        rlghData.themePath + '/assets/img/category-page-icons/save-cancel.png'

    if (lessonsId.findIndex(themeId => themeId == dataid) != -1) {
        btn.classList.add('saved')
        document
            .getElementById('current_save_profile_btn')
            .setAttribute('src', save_cancel_icon)
    } else {
        btn.classList.remove('saved')
        document
            .getElementById('current_save_profile_btn')
            .setAttribute('src', save_icon)
    }
}

function onPointerMove(e) {
    var current = document.getElementsByClassName('current-que')
    current = current[0]

    moveX = e.clientX - startX
    moveY = e.clientY - startY

    setTransform(moveX, moveY, (moveX / innerWidth) * 50)
}

function onPointerDown({ clientX, clientY }) {
    startX = clientX
    startY = clientY
    var current = document.getElementsByClassName('current-que')
    current = current[0]

    current.addEventListener('pointermove', onPointerMove)
    current.addEventListener('pointerup', onPointerUp)
    // for mobiles PointerUp for swipe function and for desktop PointerLeave for doing nothing
    if (frame[0].clientWidth <= 655) {
        current.addEventListener('pointerleave', onPointerUp)
    } else {
        current.addEventListener('pointerleave', onPointerUp)
    }
}

// function onPointerLeave() {

//     var current = document.getElementsByClassName("current-que");
//     current = current[0];

//     current.removeEventListener('pointermove', onPointerMove);
//     current.removeEventListener('pointerup', onPointerUp);

//     cancel();

// }

function onPointerUp() {
    var current = document.getElementsByClassName('current-que')
    current = current[0]

    current.removeEventListener('pointermove', onPointerMove)
    current.removeEventListener('pointerup', onPointerUp)
    current.removeEventListener('pointerleave', onPointerUp)

    var divi = 8
    if (frame[0].clientWidth <= 655) {
        divi = 8
    }
    if (Math.abs(moveX) > frame[0].clientWidth / divi) {
        current.removeEventListener('pointerdown', onPointerDown)
        complete()
        moveX = 0
    } else {
        if (moveY <= -10) {
            moveX = 0
            moveY = 0
            complete()
            /*cancel();*/
        } else {
            cancel()
            current.querySelector('.is-like').classList = 'is-like'
        }
    }
}

if (document.querySelector('.yes-swipe-right')) {
    document.querySelector('.yes-swipe-right').onclick = () => {
        moveX = 1
        moveY = 0
        complete()
    }
}

if (document.querySelector('.no-swipe-left')) {
    document.querySelector('.no-swipe-left').onclick = () => {
        moveX = -1
        moveY = 0
        complete()
    }
}

if (document.querySelector('.idk-swipe-up')) {
    document.querySelector('.idk-swipe-up').onclick = () => {
        moveX = 0
        moveY = 0
        complete()
    }
}

if (document.querySelector('.back-btn')) {
    document.querySelector('.back-btn').onclick = e => {
        moveX = -2
        moveY = 0
        complete()

        setTimeout(function () {
            var currentq = document.getElementsByClassName('back-btn')
            currentq = currentq[0]
            var dataid = currentq.getAttribute('data-lesson')

            document.getElementById('que-img-' + dataid).style.display = ''
            document.getElementById('que-question-' + dataid).style.display = ''
            document.getElementById('que-play-' + dataid).style.display = ''

            document.getElementById('que-video-' + dataid).style.display = 'none'
            document.getElementById('que-video-player-' + dataid).setAttribute('src', '')
        }, 500)
    }
}

// Click event on current category button on Suggestion Card each after each tunnel card
if (document.getElementById('cp-sugeestion-current-category-button')) {
    const current_catgory_btn = document.getElementById(
        'cp-sugeestion-current-category-button'
    )
    current_catgory_btn.addEventListener('click', () => {
        document.getElementById('que_list_sec').classList.remove('display-none')
        document.getElementById('que_list_sec').classList.add('display-block')
        document
            .getElementById('cp-category-suggestion-wrap')
            .classList.remove('display-flex')
        document
            .getElementById('cp-category-suggestion-wrap')
            .classList.add('display-none')
    })
}
// Click event on current category button on Questionaire Test Card after each tunnel card
if (document.getElementById('cp-test-current-category-button')) {
    const current_catgory_btn = document.getElementById(
        'cp-test-current-category-button'
    )
    current_catgory_btn.addEventListener('click', () => {
        if (cp_other_screen_visible == 'true') {
            // if last card is tunnel card then we have some other screen visible on yes or idk swipe
            // we have hidden Congrats screen, page load and with localstorage, congrats screen will be visible
            // Saving data
            var ele = document.getElementById('tunnel__button2')
            if (typeof ele.click == 'function') {
                ele.click()
            } else if (typeof ele.onclick == 'function') {
                ele.onclick()
            }
            location.reload()
        }
        document.getElementById('que_list_sec').classList.remove('display-none')
        document.getElementById('que_list_sec').classList.add('display-block')
        document
            .getElementById('cp-category-test-wrap')
            .classList.remove('display-flex')
        document
            .getElementById('cp-category-test-wrap')
            .classList.add('display-none')
    })
}

// Scroll page if double fingers scroll on cards
if (document.querySelectorAll('.que-list-box')) {
    let lastTouchY
    let que_cards = document.querySelectorAll('.que-list-box')
    que_cards.forEach(card => {
        card.addEventListener('touchstart', event => {
            if (event.touches.length === 2) {
                event.preventDefault()
                lastTouchY = event.touches[0].clientY

                card.removeEventListener('pointermove', onPointerMove)
                card.removeEventListener('pointerup', onPointerUp)
                card.removeEventListener('pointerleave', onPointerUp)
            } else {
                card.addEventListener('pointermove', onPointerMove)
                card.addEventListener('pointerup', onPointerUp)
                card.addEventListener('pointerleave', onPointerUp)
            }
        })

        card.addEventListener('touchmove', event => {
            if (event.touches.length === 2) {
                event.preventDefault()
                newTouchY = event.touches[0].clientY
                let scrollto
                if (newTouchY < lastTouchY) {
                    // down scroll
                    scrollto = document.body.scrollTop + 150
                } else {
                    // top scroll
                    scrollto = document.body.scrollTop - 150
                }

                window.scrollTo(0, scrollto)
            }
        })
    })
}

function complete() {
    // Adding loader for 3ms
    $('html').addClass('loading')

    var cardlist_noneed_html = ''
    if (document.querySelector('.noneed')) {
        document.querySelector('.noneed').remove()
    }

    var queimg = document.getElementsByClassName('que-img')
    for (var i = 0; i < queimg.length; i++) {
        queimg[i].style.display = ''
    }
    var playbtn = document.getElementsByClassName('play-btn')
    for (var i = 0; i < playbtn.length; i++) {
        playbtn[i].style.display = ''
    }
    var quevideo = document.getElementsByClassName('que-video')
    for (var i = 0; i < quevideo.length; i++) {
        quevideo[i].style.display = 'none'
    }
    var quevideoplayer = document.getElementsByClassName('que-video-player')
    // for (var i = 0; i < quevideoplayer.length; i++) {
    //     quevideoplayer[i].setAttribute('src', '')
    // }

    if (moveX == -2) {
        var totalchk_new = 0
        if (
            document.querySelector('.tunnel__form') &&
            document.querySelector('.tunnel__button2')
        ) {
            const formf3 = document.querySelector('.tunnel__form')
            const questionsf3 = formf3.querySelectorAll('.que-list-box')
            totalchk_new = questionsf3.length
            // Temp Solution for Category Card Back Button not working starts
            if (
                document.getElementById('current_back_btn').style.cursor == 'inherit'
            ) {
                // Removing loader
                $('html').removeClass('loading')
                return false
            }
            // Temp Solution for Category Card Back Button not working ends
            if (totalchk == totalchk_new) {
                // Temp Solution for Category Card Back Button not working starts
                var newNode = back_htmlque_html[back_htmlque_html.length - 1]
                const list = document.getElementById('que-list-main')

                beforeInsertRemoveQue()
                list.insertBefore(newNode, list.children[0])

                var current2 = document.getElementsByClassName('current-que')
                current2 = current2[0]
                initCard(current2)

                setTimeout(function () {
                    current2.style.transform = `translate3d(0px, 0px, 0px) rotate(0deg)`
                    current2.style.transition = `transform 500ms`

                    setTimeout(function () {
                        current_que()
                    }, 100)
                }, 1)

                back_htmlque_html.pop()
                totalact--
                // Temp Solution for Category Card Back Button not working ends
            } else {
                var newNode = back_htmlque_html[back_htmlque_html.length - 1]
                const list = document.getElementById('que-list-main')

                beforeInsertRemoveQue()
                list.insertBefore(newNode, list.children[0])

                var current2 = document.getElementsByClassName('current-que')
                current2 = current2[0]
                initCard(current2)

                setTimeout(function () {
                    current2.style.transform = `translate3d(0px, 0px, 0px) rotate(0deg)`
                    current2.style.transition = `transform 500ms`

                    setTimeout(function () {
                        current_que()
                    }, 100)
                }, 1)

                back_htmlque_html.pop()
                totalact--
            }
        }
        // Cards Progress bar starts here
        $('.cards-progress-bar .tq-progress-card-no').text(
            parseInt($('.cards-progress-bar .tq-progress-card-no').text()) - 1
        )
        let progress_width =
            (parseInt($('.cards-progress-bar .tq-progress-card-no').text()) /
                parseInt($('.cards-progress-bar .tq-progress-total-cards').text())) *
            100
        $('.cards-progress-bar .tq-progress-bar-inner').css(
            'width',
            progress_width + '%'
        )
        // Cards Progress bar ends here

        // Removing loader
        $('html').removeClass('loading')

        // Remove z-index9999 class from card if back button pressed. With moving, card has z-index999 class.
        current2.classList.remove('z-index9999')
    } else {
        if (moveX == 0 && moveY == 0) {
            var flyX = 0
            var flyY = -3000
            setTransform(flyX, flyY, 0, innerWidth)
            var answer = 'unknow'
            document
                .querySelector('.idk-swipe-up')
                .classList.add('form-btn-highlighter')
        } else {
            var flyX = (Math.abs(moveX) / moveX) * innerWidth * 1.3
            var flyY = (moveY / moveX) * flyX
            var answer = ''
            if (flyX > 0) {
                answer = 'yes'
                document.querySelector('.yes-swipe-right').classList.add('form-btn-highlighter');

                // if user is on subcategory posts then save lesson on each swipe yes
                let save_btn = document.querySelector('.current_save_profile')
                saveLesson(save_btn, 'only_save_no_unsave');

            } else {
                answer = 'no'
                document.querySelector('.no-swipe-left').classList.add('form-btn-highlighter')
            }
            if (innerWidth < 767) {
                innerWidth = 1200
            }
            setTransform(flyX, flyY, (flyX / innerWidth) * 50, innerWidth)
        }

        // Cards Progress bar starts here
        if (parseInt($('.cards-progress-bar .tq-progress-card-no').text()) !== parseInt($('.cards-progress-bar .tq-progress-total-cards').text())) {
            $('.cards-progress-bar .tq-progress-card-no').text(
                parseInt($('.cards-progress-bar .tq-progress-card-no').text()) + 1
            )
        }
        let progress_width = (parseInt($('.cards-progress-bar .tq-progress-card-no').text()) / parseInt($('.cards-progress-bar .tq-progress-total-cards').text())) * 100
        $('.cards-progress-bar .tq-progress-bar-inner').css('width', progress_width + '%')
        // Cards Progress bar ends here

        // Removing answers buttons highlighter after one second
        setTimeout(function () {
            document.querySelectorAll('.multi-btn li').forEach(e => {
                e.classList.remove('form-btn-highlighter')
            })
        }, 1000)

        // Showing suggestion category after each tunnel question
        // current is still tunnel card, after this code current is changed
        var current_tunnel_card = document.getElementsByClassName('current-que')
        current_tunnel_card = current_tunnel_card[0]
        if (current_tunnel_card.classList.contains('tunnel-card')) {
            if (answer == 'yes') {
                if (document.querySelectorAll('.que-list-box.noneed').length === 2) {
                    cp_other_screen_visible = 'true'
                }
                // Showing suggestion category after each tunnel question if naswer is not Yes
                document.getElementById('que_list_sec').classList.remove('display-block')
                document.getElementById('que_list_sec').classList.add('display-none')
                document.getElementById('cp-category-suggestion-wrap').classList.remove('display-none')
                document.getElementById('cp-category-suggestion-wrap').classList.add('display-flex')

                let card_data = current_tunnel_card.querySelector('.question')
                document.getElementById('cp-sugeestion-new-category').innerHTML = card_data.getAttribute('datatitle')
                document.getElementById('cp-sugeestion-new-category-button-text').innerHTML = card_data.getAttribute('datatitle')
                document.getElementById('cp-sugeestion-new-category-button').href = card_data.getAttribute('data-categoryUrl')
                document.getElementById('cp-sugeestion-current-category-button-text').innerHTML = document.getElementById('que_list_sec').getAttribute('data-category')
                document.getElementById('cp-sugeestion-current-category').innerHTML = document.getElementById('que_list_sec').getAttribute('data-category')

            } else if (answer == 'unknow' && current_tunnel_card.getAttribute('data-questionaire') == 'true') {
                // Showing category test questionaire after each tunnel question if naswer is not Not Sure
                if (document.querySelectorAll('.que-list-box.noneed').length === 2) {
                    cp_other_screen_visible = 'true'
                }
                document.getElementById('que_list_sec').classList.remove('display-block')
                document.getElementById('que_list_sec').classList.add('display-none')
                document.getElementById('cp-category-test-wrap').classList.remove('display-none')
                document.getElementById('cp-category-test-wrap').classList.add('display-flex')

                let card_data = current_tunnel_card.querySelector('.question')
                if (card_data.getAttribute('dataid') == 6) {
                    document.getElementById('cp-test-new-category-text').innerHTML = 'you are depressed'
                } else {
                    document.getElementById('cp-test-new-category-text').innerHTML = card_data.getAttribute('data-question')
                }
                document.getElementById('cp-test-new-category-button').setAttribute('href',
                    card_data.getAttribute('data-categoryurl') + '?questionaire=true&returnUrl=' + window.location.href)
            }
        }

        const prev = current
        const next = current.previousElementSibling

        totalact++
        setvalue(answer)

        setTimeout(function () {
            var cdiv = document.querySelector('.current-que')
            back_htmlque_html.push(cdiv)
            rearrange_card_order()

            var cardList = document.querySelectorAll('.que-list-box')
            if (cardList.length == 1) {
                cardlist_noneed_html =
                    '<div class="que-list-box width-33 show_cards noneed" style="order:1"><div class="que-list-inner"><div class="que-img-que"></div></div></div><div class="que-list-box width-33 show_cards noneed" style="order:3"><div class="que-list-inner"><div class="que-img-que"></div></div></div>'
                document.getElementById(
                    'que-list-main'
                ).innerHTML += cardlist_noneed_html
            } else if (cardList.length == 2) {
                cardlist_noneed_html =
                    '<div class="que-list-box width-33 show_cards noneed" style="order:3"><div class="que-list-inner"><div class="que-img-que"></div></div></div>'
                document.getElementById(
                    'que-list-main'
                ).innerHTML += cardlist_noneed_html
            }

            if (document.querySelector('.current-que')) {
                var current = document.getElementsByClassName('current-que')
                current = current[0]
                initCard(current)

                setTimeout(function () {
                    current_que()
                }, 100)
            }
            // Removing loader
            $('html').removeClass('loading')
        }, 500)

        setTimeout(function () {
            const form = document.querySelector('.tunnel__form')
            // const questions = form.querySelectorAll('.form-question__variants');
            const questions = form.querySelectorAll('.form-questions')
            const radios = form.querySelectorAll('.radio')
            const btn = form.querySelector('.tunnel__button2')
            let isBtnDisabled = checkTunnelForm(questions)
            btn.disabled = isBtnDisabled

            /*if(totalact>0 && totalchk>0 && totalact==totalchk){*/

            if (cp_other_screen_visible === 'false') {
                if (!btn.disabled) {
                    btn.addEventListener('click', () => {
                        saveLessonsAnswer2(form)
                        addSuggestions2(form)

                        document.getElementById('que_list_sec').style.display = 'none'
                        document
                            .getElementById('que_list_sec')
                            .classList.remove('display-block')
                        document.getElementById('tunnel__button2').style.display = 'none'
                        document.getElementById('finished_info').style.display = ''
                    })

                    var ele = document.getElementById('tunnel__button2')
                    if (typeof ele.click == 'function') {
                        ele.click()
                    } else if (typeof ele.onclick == 'function') {
                        ele.onclick()
                    }
                } else {
                    document.getElementById('que_list_sec').style.display = ''

                    if (!btn.disabled) {
                        document.getElementById('tunnel__button2').style.display = 'none'
                    } else {
                        document.getElementById('tunnel__button2').style.display = 'none'
                    }
                    document.getElementById('finished_info').style.display = 'none'
                }
            }
        }, 600)
    }
}

function setvalue(answer) {
    var current = document.querySelector('.current-que')
    var postname = current.getAttribute('data-post')

    if (answer != '' && postname != '') {
        try {
            /*document.querySelector("#"+postname+"-"+answer).checked = true;*/
            document.getElementById(postname + '-' + answer).checked = true
        } catch (err) {
            console.log(err)
        }
    }
}

function beforeInsertRemoveQue() {
    var slides = document.getElementsByClassName('que-list-box')
    for (var i = 0; i < slides.length; i++) {
        slides[i].classList.remove('show_cards')
        slides[i].classList.remove('hide_cards')
        slides[i].classList.remove('current-que')
        slides[i].style = ''
        if (i == 0) {
            slides[i].style.order = 1
            slides[i].classList.add('show_cards')
        } else if (i == 1) {
            slides[i].style.order = 3
            slides[i].classList.add('show_cards')
        } else {
            slides[i].classList.add('hide_cards')
        }
    }
}

function rearrange_card_order() {
    document.querySelector('.current-que').remove()
    var slides = document.getElementsByClassName('que-list-box')
    for (var i = 0; i < slides.length; i++) {
        if (i < 3) {
            if (i == 0) {
                slides[i].classList.add('current-que')
                var current_data_id = slides[i].getAttribute('data-id')
                if (current_data_id !== null) {
                    var current_img = document.getElementById(
                        'que-img-' + current_data_id
                    )
                    current_img.classList.add('current-que-img')
                    var current_play = document.getElementById(
                        'que-play-' + current_data_id
                    )
                    current_play.classList.add('current-que-play')
                }
            }
            slides[i].classList.add('show_cards')
            slides[i].classList.remove('hide_cards')
        }
    }
    set_order()
    var current = ''
    if (document.querySelector('.current-que')) {
        var current = document.getElementsByClassName('current-que')
        current = current[0]
        initCard(current)
    }
}

if (document.querySelector('.show_cards')) {
    set_order()
}

function set_order() {
    var slides = document.getElementsByClassName('show_cards')
    var order = 1
    for (var i = 0; i < slides.length; i++) {
        if (i == 0) {
            order = 2
        } else if (i == 1) {
            order = 1
        } else if (i == 2) {
            order = 3
        }
        slides[i].style.order = order
    }
}

function cancel() {
    setTransform(0, 0, 0, 100)
    setTimeout(() => (current.style.transition = ''), 100)
}

function isMoreInfoPopup(e) {
    if (!e.target.closest('.popup_profile__body')) closeMoreInfoPopup()
}

function closeMoreInfoPopup() {
    const popup = document.querySelector('.video-popup-new')
    popup.classList.remove('show')
    document.getElementById('popup_category_video_link').setAttribute('src', '')
    window.removeEventListener('click', isMoreInfoPopup)
}

function isFinishedPopup(e) {
    if (!e.target.closest('.inner_body')) closeFinishedPopup()
}

function closeFinishedPopup() {
    const popup = document.querySelector('.finished_profile')
    popup.classList.remove('show')
    window.removeEventListener('click', isFinishedPopup)
}

function queimage() {
    var cue_classlist = this.parentElement.parentElement.parentElement.classList

    if (!cue_classlist.contains('current-que') ||
        cue_classlist.contains('moving')
    ) {
        return false
    }

    var datayoutube = this.dataset.datayoutube
    var dataid = this.dataset.dataid
    var dataheight = this.clientHeight

    var contact_autoplay_video = '?autoplay=1'
    if (datayoutube.indexOf('?') >= 0) {
        contact_autoplay_video = '&autoplay=1'
    }
    datayoutube = datayoutube + contact_autoplay_video

    document.getElementById('que-img-' + dataid).style.display = 'none'
    document.getElementById('que-question-' + dataid).style.display = 'none'
    document.getElementById('que-play-' + dataid).style.display = 'none'

    document.getElementById('que-video-' + dataid).style.display = ''
    document.getElementById('que-video-player-' + dataid).setAttribute('src', datayoutube)

    document.getElementById('que-video-player-' + dataid).style.height =
        dataheight + 'px'
}

function queplay() {
    var cue_classlist = this.parentElement.parentElement.parentElement.classList

    if (!cue_classlist.contains('current-que') ||
        cue_classlist.contains('moving')
    ) {
        return false
    }

    var datayoutube = this.dataset.datayoutube
    var dataid = this.dataset.dataid

    var contact_autoplay_video = '?autoplay=1'
    if (datayoutube.indexOf('?') >= 0) {
        contact_autoplay_video = '&autoplay=1'
    }
    datayoutube = datayoutube + contact_autoplay_video

    document.getElementById('que-img-' + dataid).style.display = 'none'
    document.getElementById('que-question-' + dataid).style.display = 'none'
    document.getElementById('que-play-' + dataid).style.display = 'none'

    document.getElementById('que-video-' + dataid).style.display = ''
    document.getElementById('que-video-player-' + dataid).setAttribute('src', datayoutube)
}

function quequestion() {
    var cue_classlist = this.parentElement.parentElement.parentElement.classList
    if (!cue_classlist.contains('current-que') || cue_classlist.contains('moving')) {
        return false
    }

    let reminder_link = $(".js-start-reminder-btn").attr("href") + this.parentElement.parentElement.parentElement.getAttribute('data-id')
    $(".js-start-reminder-btn").attr("href", reminder_link);
    /*if(typeof e.click == 'function') {
                          e.click();
                      } else if(typeof ele.onclick == 'function') {
                          e.onclick();
                      }*/
    let crnt = $(this);
    if (crnt.find('.sc-ui-post-exerices-content').length !== 0) {
        $('.js-show-start-exercise-screen').css('display', 'flex')
        $('.js-show-start-exercise-screen').attr('data-targetcards', 'queListBox')
    } else {
        $('.js-show-start-exercise-screen').css('display', 'none')
    }

    var popup = document.querySelector('.video-popup-new')
    popup.classList.add('show')

    lockScroll()
    const close_btn = popup.querySelector('.close-video-popup-new')
    close_btn.addEventListener('click', function () {
        popupVideo(popup, 'pause')
        popup.classList.remove('show')
        unlockScroll()
    })

    var dataid = this.dataset.dataid
    var datatitle = this.dataset.datatitle
    var datayoutube = this.dataset.datayoutube

    var contact_autoplay_video = '?autoplay=1'
    if (datayoutube.indexOf('?') >= 0) {
        contact_autoplay_video = '&autoplay=1'
    }
    // datayoutube = datayoutube + contact_autoplay_video

    document
        .getElementById('popup_category_video_link')
        .setAttribute('src', datayoutube)
    document.getElementById('popup_category_title').innerHTML = datatitle

    var data_text = document.getElementById('data_text_' + dataid).innerHTML
    document.getElementById('popup_category_text').innerHTML = data_text

    var cond_list = document.getElementById('data_list_' + dataid).innerHTML
    document.getElementById('cond_list').innerHTML = cond_list

    var data_other = document.getElementById('data_other_' + dataid).innerHTML
    document.getElementById('data_other').innerHTML = data_other
    if (data_other == '') {
        document.getElementById('other-resources').style.display = 'none'
    } else {
        document.getElementById('other-resources').style.display = ''
    }

    other_resource_link_appear()

    window.removeEventListener('click', isMoreInfoPopup)
    setTimeout(function () {
        window.addEventListener('click', isMoreInfoPopup)
    }, 200)
}

function queclose() {
    var dataid = this.dataset.dataid

    document.getElementById('que-img-' + dataid).style.display = ''
    document.getElementById('que-question-' + dataid).style.display = ''
    document.getElementById('que-play-' + dataid).style.display = ''

    document.getElementById('que-video-' + dataid).style.display = 'none'
    document.getElementById('que-video-player-' + dataid).setAttribute('src', '')
}

function moreinfoclosevideopopup() {
    var popup = document.querySelector('.video-popup-new')
    popup.classList.remove('show')
    document.getElementById('popup_category_video_link').setAttribute('src', '')
}

function firstprofileclose() {
    var popup = document.querySelector('.first_video')
    popup.classList.remove('show')
    document.getElementById('first_video_link').setAttribute('src', '')
}

function finishedprofileclose() {
    var popup = document.querySelector('.finished_profile')
    popup.classList.remove('show')
}

function other_resource_link_appear() {
    Array.from(document.querySelectorAll('.other-resource-img')).forEach(e => {
        e.dataset.dataid = e.getAttribute('dataid')
        e.dataset.dataindex = e.getAttribute('dataindex')
        e.dataset.datatitle = e.getAttribute('title')
        e.dataset.datayoutube = e.getAttribute('datayoutube')
        e.addEventListener('click', function () {
            var dataid = this.dataset.dataid
            var dataindex = this.dataset.dataindex
            var datatitle = this.dataset.datatitle
            var datayoutube = this.dataset.datayoutube

            var contact_autoplay_video = '?autoplay=1'
            if (datayoutube.indexOf('?') >= 0) {
                contact_autoplay_video = '&autoplay=1'
            }
            datayoutube = datayoutube + contact_autoplay_video

            document
                .getElementById('popup_category_video_link')
                .setAttribute('src', datayoutube)
            document.getElementById('popup_category_title').innerHTML = datatitle

            var popup_category_text = document.getElementById(
                'data_other_resource_' + dataindex + '_' + dataid
            ).innerHTML
            document.getElementById(
                'popup_category_text'
            ).innerHTML = popup_category_text

            document.body.scrollTop = 0
            setTimeout(function () {
                window.addEventListener('click', isMoreInfoPopup)
            }, 200)
        })
    })
}

/* ------------------------Animation Function----------------------------- */
function setTransform(x, y, deg, duration) {
    var current = document.getElementsByClassName('current-que')
    $('.que-list-box').removeClass('z-index9999')
    current = current[0]
    if (x !== 0 || y !== 0) {
        current.classList.add('moving')
        current.classList.add('z-index9999')
    } else {
        window.setTimeout(function () {
            current.classList.remove('moving')
        }, 300)
        current.classList.remove('z-index9999')
    }
    current.style.transform = `translate3d(${x}px, ${y}px, 0) rotate(${deg}deg)`
    const likeText = current.querySelector('.is-like')
    if (typeof likeText !== 'undefined') {
        if (x < 0 && Math.abs(y) < Math.abs(x)) {
            likeText.className = `is-like nope`
        } else if (x > 0 && Math.abs(y) < Math.abs(x)) {
            likeText.className = `is-like yes`
        } else if (y < 0) {
            likeText.className = `is-like idk`
        }
    }

    if (duration) current.style.transition = `transform ${duration}ms`
}

/*
 * ---------------------------Card swipe animation ends--------------------------------
 */

/*
 * ------------------------Send Suggestions for cards aanimation popup starts-----------------------------
 */
window.setTimeout(function () {
    if (document.querySelector('.suggestion__form2')) {
        sendSuggestionInit2()
    }
}, 3000)

function sendSuggestionInit2() {
    const form = document.querySelector('.suggestion__form2')
    form.addEventListener('submit', e => sendSuggestion2(e, form))
}

async function sendSuggestion2(e, form) {
    e.preventDefault()
    document.documentElement.classList.add('loading')

    const formData = new FormData(form)
    formData.append('action', 'suggestion')

    fetch(rlghData.ajaxurl, {
        method: 'POST',
        body: formData
    })
        .then(response => {
            form.reset()
        })
        .then(response => {
            form.querySelector('.form-success-message').style.display = 'block'
        })
        .then(response => {
            document.documentElement.classList.remove('loading')
        })
        .catch(error => {
            console.error('Error:', error)
        })
}

function showPopup2(popupClass) {
    if (isAnimated) return
    isAnimated = true
    setTimeout(() => (isAnimated = false), HOVERTIME)

    var popup2 = document.querySelector('.video-popup-new')
    popup2.classList.remove('show')

    const popup = document.querySelector(`.${popupClass}__popup`)
    const closeBtn = popup.querySelector('.close-button')

    lockScroll()
    popup.classList.add('show')

    if (popup.classList.contains('video-popup')) popupVideo(popup, 'play')

    window.addEventListener('click', isClosePopup)
    if (closeBtn) closeBtn.addEventListener('click', closePopup)

    function isClosePopup(e) {
        if (!e.target.closest('.popup__body')) closePopup()
    }

    function closePopup() {
        if (isAnimated) return
        isAnimated = true
        setTimeout(() => (isAnimated = false), HOVERTIME)

        window.removeEventListener('click', isClosePopup)
        if (closeBtn) closeBtn.removeEventListener('click', closePopup)
        if (popup.classList.contains('video-popup')) popupVideo(popup, 'pause')

        unlockScroll()
        popup.classList.remove('show')
    }
}

function addSuggestions2(form) {
    const formBlocks = form.querySelectorAll('.js-main-quest')
    const row = window.localStorage.getItem('themes_suggest')
    const suggestions = row ? JSON.parse(row) : {}

    formBlocks.forEach(block => {
        const answer = block.dataset.answer

        if (block.querySelector('.radio:checked')) {
            const radioBtn = block.querySelector('.radio:checked')
            const radioValue = radioBtn.value
            const radioKey = radioBtn.name
            suggestions[radioKey] = answer == radioValue ? 'yes' : 'no'
        }
    })
}

function saveLessonsAnswer2(form) {
    const formBlocks = form.querySelectorAll('.js-sec-quest')
    const row = window.localStorage.getItem('lessons_answer')
    const lessonsAnswer = row ? JSON.parse(row) : {}

    formBlocks.forEach(block => {
        const radioBtn = block.querySelector('.radio:checked')
        const radioValue = radioBtn.value
        const radioKey = radioBtn.name
        lessonsAnswer[radioKey] = radioValue
    })

    window.localStorage.setItem('lessons_answer', JSON.stringify(lessonsAnswer))
    // Save Data to database
    if ($("body").hasClass('logged-in')) {
        saveLocalStorageDataToDB('lessons_answer')
    }
}
/*
 * ------------------------Send Suggestions for cards aanimation popup ends-----------------------------
 */

/*
 * ------------------------Cards Tutotrial Show/Hide  For Default Cards Design starts here-----------------------------
 */
if (document.getElementById('za_category_page') && document.querySelector('.tunnel__form') && getParameterByName('questionaire') === null) {
    let showCardsTutorial = window.localStorage.getItem('show_cards_tutorial')

    if (showCardsTutorial == 'no') {
        document.getElementById('za_category_page').classList.remove('za-show-card-tutorial1')
    } else {
        if (document.querySelector('body').classList.contains('category-8')) {
            // For sleep better category, tutorial will be shown on CONTINUE button click
        } else {
            document.getElementById('za_category_page').classList.add('za-show-card-tutorial1')

            const body = document.querySelector('.wellbeing-category-page')
            let count = 1
            body.addEventListener('click', () => {
                if (count == 1) {
                    document.getElementById('za_category_page').classList.remove('za-show-card-tutorial1')
                    document.getElementById('za_category_page').classList.add('za-show-card-tutorial2')
                    count++
                } else {
                    document.getElementById('za_category_page').classList.remove('za-show-card-tutorial2')
                    window.localStorage.setItem('show_cards_tutorial', 'no')
                    // Save Data to database
                    if ($("body").hasClass('logged-in')) {
                        saveLocalStorageDataToDB('show_cards_tutorial')
                    }
                }
            })
        }
    }
}
/*
 * ------------------------Cards Tutotrial Show/Hide  For Default Cards Design ends here-----------------------------
 */

/*
 * ------------------------Tunnel Test Questionaire starts-----------------------------
 */

jQuery(document).ready(function ($) {
    $(document).on('click', '#tq-start-test', function () {
        $('.tq-first-screen').fadeOut(function () {
            $('.tq-second-screen__questions')
                .fadeIn()
                .css('display', 'flex')
        })
    })

    $(document).on('click', '.tq-question-answer', function () {
        var crnt = $(this)
        crnt
            .parents('.tq-answers-wrap')
            .find('.tq-question-answer')
            .removeClass('tq-active')
        crnt.addClass('tq-active')
    })

    $(document).on('click', '.tq-next-question', function () {
        var crnt = $(this)

        if (crnt.parents('.tq-questions-inner').find('.tq-active').length !== 0) {
            const next_question = crnt
                .parents('.tq-questions-inner')
                .next('.tq-questions-inner')
            if (next_question.length !== 0) {
                crnt.parents('.tq-questions-inner').fadeOut(function () {
                    next_question.fadeIn()
                    let next_question_data = next_question.find('.tq-questions-question')
                    let progress_width =
                        (parseInt(next_question_data.attr('data-question')) /
                            parseInt(next_question_data.attr('data-totalQuestions'))) *
                        100
                    $('.tq-progress-bar-inner').css('width', progress_width + '%')
                    $('.tq-progress-quest-no').text(
                        next_question_data.attr('data-question')
                    )
                })
            }
        } else {
            alert('Please select an answer')
        }
    })

    $(document).on('click', '.tq-back-question', function () {
        var crnt = $(this)

        let prev_question = crnt
            .parents('.tq-questions-inner')
            .prev('.tq-questions-inner')
        if (prev_question.length !== 0) {
            crnt.parents('.tq-questions-inner').fadeOut(function () {
                prev_question.fadeIn()
                let prev_question_data = prev_question.find('.tq-questions-question')
                let progress_width =
                    (parseInt(prev_question_data.attr('data-question')) /
                        parseInt(prev_question_data.attr('data-totalQuestions'))) *
                    100
                $('.tq-progress-bar-inner').css('width', progress_width + '%')
                $('.tq-progress-quest-no').text(
                    prev_question_data.attr('data-question')
                )
            })
        }

        if (prev_question.prev('.tq-questions-inner').length === 0) {
            prev_question.addClass('tq-no-back-btn')
        }
    })

    $(document).on('click', '#tq-view-results', function (e) {
        e.preventDefault()

        // Getting today's date starts
        const today = new Date()
        let mm = today.getMonth() + 1 // Months start at 0!
        let dd = today.getDate()
        if (dd < 10) dd = '0' + dd
        if (mm < 10) mm = '0' + mm
        const formattedToday = dd + '/' + mm + '/' + today.getFullYear()
        // Getting today's date ends

        var total_score = 0
        $('.tq-question-answer.tq-active').each(function () {
            var crnt = $(this)
            total_score += parseInt(crnt.attr('data-scale'))
        })
        $('.tq-score-acheived').html(total_score)
        $('.tq-js-date').html(formattedToday)

        const categoryName = $('#za_category_page').attr('data-categorySlug')
        const tq_score = $('.tq-js-score').text().replace(/\s/g, '')
        const row = window.localStorage.getItem('questionaire_results')
        const questionaire_results = row ? JSON.parse(row) : {}
        if (typeof questionaire_results[categoryName] === 'undefined') {
            questionaire_results[categoryName] = tq_score + '-' + formattedToday
        } else {
            questionaire_results[categoryName] = questionaire_results[categoryName] + ',' + tq_score + '-' + formattedToday
        }
        window.localStorage.setItem('questionaire_results', JSON.stringify(questionaire_results))
        // Save Data to database
        if ($("body").hasClass('logged-in')) {
            saveLocalStorageDataToDB('questionaire_results')
        }

        let result_type = $('.js-tq-all-results').attr('data-resultType')
        if (result_type == 'single') {
            $('.tq-test-result-desc').addClass('single-test-result')
            let result = $('.js-tq-all-results').html();
            result.replaceAll('\'', '');
            $('.tq-test-result-title').hide()
            $('.tq-test-result-desc').html(result)
            tq_score_img = $('.js-tq-all-results-img').attr('src')
            $('.tq-score-image').attr('src', tq_score_img)
        } else {
            let all_results = $.trim($('.js-tq-all-results').text()).split('/')
            let count = (targer_desc = 0)
            all_results.forEach(result => {
                let score_result = result.split(',')
                let startScore_EndScore = score_result[0].split('-')
                if (
                    total_score >= parseInt(startScore_EndScore[0]) &&
                    total_score <= parseInt(startScore_EndScore[1])
                ) {
                    $('.tq-test-result-title').html(score_result[1])
                    targer_desc = count
                }
                count++
            })
            //Getting Result Description from category page HTML, all results are separated by "/new_result_break"
            let result_desc = $('.js-tq-all-results-desc')
                .html()
                .split('/new_result_break')
            result_desc = result_desc[parseInt(targer_desc)]
            $('.tq-test-result-desc').html(result_desc)
            let result_image = $('.js-tq-all-results-images')
                .html()
                .split('/new_result_break')
            result_image = result_image[parseInt(targer_desc)]
            $('.tq-score-image').attr('src', result_image)
        }

        $(document).on(
            'click',
            '.single-test-result.tq-test-result-desc p:nth-child(1)',
            function () {
                $('.single-test-result.tq-test-result-desc p').addClass('dis-block')
                $('.single-test-result.tq-test-result-desc p:nth-child(1)').addClass(
                    'p-hidden-after'
                )
            }
        )

        $('.tq-second-screen__questions').fadeOut(function () {
            $('.tq-third-score-screen')
                .fadeIn()
                .css('display', 'flex')
        })
    })

    $(document).on('click', '#tq-finish-test', function () {
        // if (getParameterByName('returnUrl') !== null) {
        //     let prev_cat_name = getParameterByName('returnUrl').split('/')
        //     prev_cat_name = prev_cat_name[prev_cat_name.length - 2]
        //     $('.tq-prev-cat-name').text(prev_cat_name)
        //     $('.tq-prev-cat-url').attr('href', getParameterByName('returnUrl'))
        //     $('.tq-complete-test-again').attr(
        //         'href',
        //         '?questionaire=true&returnUrl=' + getParameterByName('returnUrl')
        //     )
        // } else {
        //     $('.tq-prev-cat-url').css('display', 'none')
        // }
        // hiding the last screen for now
        // location.reload();
        debugger

        $('.tq-third-score-screen').fadeOut(function() {
            $('.tq-fourth-congrats-screen .tq-content-inner').html('<h2 style="font-size: 20px;line-height:30px;" class="tq-content-main-title col-black m-b-15">Congratulation, you have finished the test. Please click the close button to close this test.</h2>')
            $('.tq-fourth-congrats-screen')
                .fadeIn()
                .attr('style', 'display:flex')
        })
    })

    if (document.querySelector('.questionaire-test-results')) {
        const questionaire_results = JSON.parse(window.localStorage.getItem('questionaire_results'));
        const questionaire_untakenTests = JSON.parse(window.localStorage.getItem('saved_untakenTests'));
        if (questionaire_results !== null || questionaire_untakenTests !== null) {
            $('.q-tr-no-results').css('display', 'none')
            $.each(questionaire_untakenTests, function (key, value) {
                let categoryId = value;
                jQuery.ajax({
                    type: "post",
                    url: rlghData.ajaxurl,
                    data: {
                        action: "get_category_meta_data",
                        cat_id: categoryId,
                    },
                    success: function (response) {
                        // console.log(response);
                        response = JSON.parse(response);
                        const resultTemp = document.querySelector('#temp_testResult')
                        const resultDate = resultTemp.content.querySelector('.q-tr-item-date')
                        const resultBoxItem = resultTemp.content.querySelector('.q-tr-item')
                        const resultText = resultTemp.content.querySelector('.q-tr-title')
                        const resultImg = resultTemp.content.querySelector('.q-tr-result-image')
                        const resultScore = resultTemp.content.querySelector('.q-tr-test-result')

                        resultDate.innerHTML = new Date().toLocaleDateString();
                        resultBoxItem.setAttribute('data-category', response.category)
                        resultText.innerHTML = response.category + ' Test'
                        resultImg.src = response.cat_meta.questionaire_test_image
                        resultScore.innerHTML = 'Not Taken';

                        const resultBox = resultTemp.content.cloneNode(true)
                        $('.q-tr-items').append(resultBox)

                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            })
            $.each(questionaire_results, function (key, value) {
                let category
                category = key
                results = value.split(',')
                $.each(results, function (key, value) {
                    value = value.split('-')
                    result = value[0]
                    date = value[1]

                    jQuery.ajax({
                        type: "post",
                        url: rlghData.ajaxurl,
                        data: {
                            action: "get_category_meta_data",
                            cat_slug: category,
                        },
                        success: function (response) {
                            // console.log(response);
                            response = JSON.parse(response);
                            const resultTemp = document.querySelector('#temp_testResult')
                            const resultDate = resultTemp.content.querySelector('.q-tr-item-date')
                            const resultBoxItem = resultTemp.content.querySelector('.q-tr-item')
                            const resultText = resultTemp.content.querySelector('.q-tr-title')
                            const resultImg = resultTemp.content.querySelector('.q-tr-result-image')
                            const resultScore = resultTemp.content.querySelector('.q-tr-test-result')

                            resultDate.innerHTML = date
                            resultBoxItem.setAttribute('data-category', category)
                            // Here category is slug so convert it to category name
                            resultText.innerHTML = category.replaceAll('-', ' ') + ' Test'
                            resultImg.src = response.cat_meta.questionaire_test_image
                            resultScore.innerHTML = result

                            const resultBox = resultTemp.content.cloneNode(true)
                            $('.q-tr-items').append(resultBox)

                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                })
            })
            $(document).on('click', '.js-show-results-screen', function () {

                var crnt = $(this)
                let category = crnt.attr('data-category').toLowerCase()
                if (crnt.find('.q-tr-test-result').text() === 'Not Taken') {
                    redirectUrl = rlghData.siteUrl + '/category/' + category + '?questionaire=true';
                } else {
                    redirectUrl = rlghData.siteUrl + '/category/' + category + '?questionaire=true&show_results=' + crnt.find('.q-tr-test-result').text() +
                        '&date=' + crnt.parents('.q-tr-item-wrap').find('.q-tr-item-date').text()
                }
                window.location.href = redirectUrl
            })
        }
    }

    if (document.querySelector('.show-test-results')) {
        $('.tq-js-score').text(getParameterByName('show_results'))
        $('.tq-js-date').text(getParameterByName('date'))

        let total_score = getParameterByName('show_results').split('/')
        total_score = total_score[0]
        let result_type = $('.js-tq-all-results').attr('data-resultType')
        if (result_type == 'single') {
            $('.tq-test-result-desc').addClass('single-test-result')
            let result = $('.js-tq-all-results').html()
            result = result.replaceAll(/\\/g, '');
            $('.tq-test-result-title').hide()
            $('.tq-test-result-desc').html(result)
            tq_score_img = $('.js-tq-all-results-img').attr('src')
            $('.tq-score-image').attr('src', tq_score_img)
        } else {
            let all_results = $.trim($('.js-tq-all-results').text()).split('/')
            let count = (targer_desc = 0)
            all_results.forEach(result => {
                let score_result = result.split(',')
                let startScore_EndScore = score_result[0].split('-')
                if (
                    total_score >= parseInt(startScore_EndScore[0]) &&
                    total_score <= parseInt(startScore_EndScore[1])
                ) {
                    $('.tq-test-result-title').html(score_result[1])
                    targer_desc = count
                }
                count++
            })
            //Getting Result Description from category page HTML, all results are separated by "/new_result_break"
            let result_desc = $('.js-tq-all-results-desc')
                .html()
                .split('/new_result_break')
            result_desc = result_desc[parseInt(targer_desc)]
            $('.tq-test-result-desc').html(result_desc)
            let result_image = $('.js-tq-all-results-images')
                .html()
                .split('/new_result_break')
            result_image = result_image[parseInt(targer_desc)]
            $('.tq-score-image').attr('src', result_image)
        }
        // $('.tq-score-image').attr('src', tq_score_img)
        $('.tq-third-score-screen').css('display', 'flex')
    }

    $(document).on('click', '.tq-test-result-title', function () {
        $('.tq-test-result-desc').addClass('dis-block')
        $('.tq-test-result-title').addClass('hidden-after')
    })
})

/*
 * ------------------------Tunnel Test Questionaire ends-----------------------------
 */




/*
 * ----------------Sub Category New Cards Design Starts here---------------------
 * ----------------Sub Category New Cards Design Starts here---------------------
 * ----------------Sub Category New Cards Design Starts here---------------------
 */

// Save strategies
$(document).on('click', '#scs-ui-quests-all-wrap .sc_current_save_profile', function () {
    let btn = $(this);
    process_save_lessons(btn);
})

function process_save_lessons(btn, save_action) {
    btn.toggleClass('saved')

    if (save_action === "only_save_no_unsave") {
        // check if post is already saved then return otherwise save
        if (!btn.hasClass('saved')) {
            return false
        }
    }

    const save_icon =
        rlghData.themePath + '/assets/img/category-page-icons/save-btn.svg'
    const save_cancel_icon =
        rlghData.themePath + '/assets/img/category-page-icons/save-cancel.png'

    if (btn.hasClass('saved')) {
        const row = window.localStorage.getItem('saved_lessons')
        const lessonsId = row ? JSON.parse(row) : []
        lessonsId.push(btn.attr('data-lesson'))
        window.localStorage.setItem('saved_lessons', JSON.stringify(lessonsId))

        $('.sc_current_save_profile_btn').attr('src', save_cancel_icon)

        $('.cp-action-popup').css('display', 'block')
        window.setTimeout(function () {
            $('.cp-action-popup').css('display', 'none')
        }, 4000)

        // save the cards postid and post tile in array. this will be used to show reminder screen at the end of cards
        if (current_cards === '#scs-ui-quests-cards-wrap ') {
            var sc_current = $(current_cards + '.sc-current-card')
            let postdetailsObj = { id: sc_current.attr('data-postid'), title: sc_current.find('.sc-ui-card-quest').text() };
            yes_answer_arr.push(postdetailsObj);
        }

        // add the strategy exercise button if exercise content is not emplty
        if ($(current_cards + '.sc-current-card .sc-ui-post-exerices-content').length !== 0) {
            crnt_subcat_posts_saved_strategies_count++
            // Getting current post details;
            let postid = $(current_cards + '.sc-current-card').attr('data-postid')
            let post_title = $(current_cards + '.sc-current-card .sc-ui-card-quest').text()
            let post_exercise_strategy = $(current_cards + '.sc-current-card .sc-ui-card-quest').text()
            let post_exercise_strategy_href = $(current_cards + '.sc-current-card .sc-ui-card-quest').attr('data-permalink')
            let post_exercise_title = $(current_cards + '.sc-current-card .sc-ui-card-quest-content .sc-ui-post-exerices-title').text()
            let post_exercise_description = $(current_cards + '.sc-current-card .sc-ui-card-quest-content .sc-ui-post-exerices-description').html()
            let post_exercise_template = $(current_cards + '.sc-current-card .sc-ui-card-quest-content .sc-ui-post-exerices-template').html()
            $('.sc-ui-strategies-btns').append('\
                <div class="m-b-10 js-show-exercise-screen">\
                    <a href="#" class="button button--big blue-button" data-postid="' + postid + '"><span class="button-text">' + post_title + '</span></a>\
                    <h2 class="scbtn-exercise-title" style="display:none;">' + post_exercise_title + '</h2>\
                    <p class="scbtn-exercise-description" style="display:none;">' + post_exercise_description + '</p>\
                    <a class="scbtn-strategy" style="display:none;" data-permalink="' + post_exercise_strategy_href + '">' + post_exercise_strategy + '</a>\
                    <p class="scbtn-exercise-template" style="display:none;">' + post_exercise_template + '</p>\
                </div>')
        }
    } else {
        const row = window.localStorage.getItem('saved_lessons')
        const lessonsId = JSON.parse(row)
        const idx = lessonsId.findIndex(
            themeId => themeId == btn.attr('data-lesson')
        )
        lessonsId.splice(idx, 1)
        window.localStorage.setItem('saved_lessons', JSON.stringify(lessonsId))

        $('.sc_current_save_profile_btn').attr('src', save_icon)
    }
    // Save Data to database
    if ($("body").hasClass('logged-in')) {
        saveLocalStorageDataToDB('saved_lessons')
    }
}

// Save Test Cards if user hasn't started a test
$(document).on('click', '#sc-ui-testsquests-all-wrap .sc_current_save_profile', function () {
    let btn = $(this);
    btn.toggleClass('saved')

    const save_icon = rlghData.themePath + '/assets/img/category-page-icons/save-btn.svg'
    const save_cancel_icon = rlghData.themePath + '/assets/img/category-page-icons/save-cancel.png'

    if (btn.hasClass('saved')) {

        const row = window.localStorage.getItem('saved_untakenTests')
        const lessonsId = row ? JSON.parse(row) : []
        lessonsId.push(btn.attr('data-lesson'))
        window.localStorage.setItem('saved_untakenTests', JSON.stringify(lessonsId))

        $('.sc_current_save_profile_btn').attr('src', save_cancel_icon)

        $(".cp-action-popup .title").text('Test was saved in My Progress')
        $('.cp-action-popup').css('display', 'block')
        window.setTimeout(function () {
            $('.cp-action-popup').css('display', 'none')
        }, 4000)
    } else {
        const row = window.localStorage.getItem('saved_untakenTests')
        const lessonsId = JSON.parse(row)
        const idx = lessonsId.findIndex(
            themeId => themeId == btn.attr('data-lesson')
        )
        lessonsId.splice(idx, 1)
        window.localStorage.setItem('saved_untakenTests', JSON.stringify(lessonsId))

        $('.sc_current_save_profile_btn').attr('src', save_icon)
    }
    // Save Data to database
    if ($("body").hasClass('logged-in')) {
        saveLocalStorageDataToDB('saved_untakenTests')
    }
})


// First screen with uner instructions
$(document).on('click', '.sc-ui-first-cont-btn', function () {
    let crnt = $(this)
    crnt.parents('.sc-ui-design').fadeOut(function () {
        crnt.parents('.sc-ui-design').next('.sc-ui-design').fadeIn()
    })
})


// Second screen with cards

var sc_moveX = 0
var sc_moveY = 0
var sc_startX = 0
var sc_startY = 0
var sc_totalchk = 0
var sc_totalact = 0
var sc_back_htmlque_html = new Array()
var current_cards = '#sc-ui-quests-cards-wrap '
var current_all_wrap = '#sc-ui-quests-all-wrap '
var sc_current = document.querySelectorAll(current_cards + '.sc-current-card')
sc_current = sc_current[0]
var sc_frame = document.getElementById('sc-ui-quests-cards-wrap')
var no_answer_count = 0;
var yes_answer_arr = new Array();
var crnt_subcat_posts_saved_strategies_count = 0

var sub_cat_all_posts = $('#scs-ui-quests-cards-wrap').html()



// if page is my-progress then set things for tests cards
if (document.querySelector('.page-template-template-my-strategies')) {

    current_cards = '#sc-ui-quests-cards-wrap '
    current_all_wrap = '#sc-ui-testsquests-all-wrap '
    sc_current = document.querySelector(current_cards + '.sc-current-card')
    sc_back_htmlque_html = new Array()
    sc_frame = document.getElementById('sc-ui-quests-cards-wrap')
    no_answer_count = 0;

    $(document).on('click', '.btn-take-test', function (e) {
        e.preventDefault()

        var crnt = $(this);

        $(".single-main-content").fadeOut(function () {
            $("#sc-ui-testsquests-all-wrap").fadeIn();
            const newUrl = `${window.location.href}?test-cards`;
            window.history.pushState({ path: newUrl }, '', newUrl);
        });

    })
}




function sc_beforeInsertRemoveQue() {
    var sc_slides = document.querySelectorAll(
        current_cards + '.sc-ui-quests-card'
    )
    for (var i = 0; i < sc_slides.length; i++) {
        sc_slides[i].classList.remove('sc-show-cards')
        sc_slides[i].classList.remove('sc-hide-cards')
        sc_slides[i].classList.remove('sc-current-card')
        sc_slides[i].style = ''
        if (i == 0) {
            sc_slides[i].style.order = 1
            sc_slides[i].classList.add('sc-show-cards')
        } else if (i == 1) {
            sc_slides[i].style.order = 3
            sc_slides[i].classList.add('sc-show-cards')
        } else {
            sc_slides[i].classList.add('sc-hide-cards')
        }
    }
}

function sc_rearrange_card_order() {
    if (document.querySelector(current_cards + '.sc-current-card')) {
        document.querySelector(current_cards + '.sc-current-card').remove()
    }
    var sc_slides = document.querySelectorAll(
        current_cards + '.sc-ui-quests-card'
    )
    for (var i = 0; i < sc_slides.length; i++) {
        if (i < 3) {
            if (i == 0) {
                sc_slides[i].classList.add('sc-current-card')
            }
            sc_slides[i].classList.add('sc-show-cards')
            sc_slides[i].classList.remove('sc-hide-cards')
        } else {
            sc_slides[i].classList.add('sc-hide-cards')
        }
    }
    sc_set_order()
    var sc_current = ''

    if (document.querySelector(current_cards + '.sc-current-card')) {
        var sc_current = document.querySelector(current_cards + '.sc-current-card')
        sc_initCard(sc_current)
    }
}

if (document.querySelector('.sc-show-cards')) {
    sc_set_order()
}

function sc_set_order() {
    var sc_slides = document.querySelectorAll(current_cards + '.sc-show-cards')
    var sc_order = 1
    for (var i = 0; i < sc_slides.length; i++) {
        if (i == 0) {
            sc_order = 2
        } else if (i == 1) {
            sc_order = 1
        } else if (i == 2) {
            sc_order = 3
        }
        sc_slides[i].style.order = sc_order
    }
}

if (typeof sc_current !== 'undefined') {
    let sc_likeText = sc_current.children[0]
    let sc_startX = 0,
        sc_startY = 0,
        sc_moveX = 0,
        sc_moveY = 0
    sc_initCard(sc_current)
}

function sc_initCard(card) {
    var sc_current = document.querySelector(current_cards + '.sc-current-card')
    card.addEventListener('pointerdown', sc_onPointerDown)

    if (sc_back_htmlque_html.length == 0) {
        document.querySelector(current_all_wrap + '.sc-back-btn').style.opacity = '0.5'
        document.querySelector(current_all_wrap + '.sc-back-btn').style.cursor = 'inherit'
    } else {
        document.querySelector(current_all_wrap + '.sc-back-btn').style.opacity = '1'
        document.querySelector(current_all_wrap + '.sc-back-btn').style.cursor = 'pointer'
    }

    let dataid = card.getAttribute('data-postid')
    $('#scs-ui-quests-all-wrap .sc_current_save_profile').attr('data-lesson', dataid)

    const row = window.localStorage.getItem('saved_lessons')
    const lessonsId = row ? JSON.parse(row) : []
    const save_icon = rlghData.themePath + '/assets/img/category-page-icons/save-btn.svg'
    const save_cancel_icon = rlghData.themePath + '/assets/img/category-page-icons/save-cancel.png'

    if (lessonsId.findIndex(themeId => themeId == dataid) != -1) {
        $('#scs-ui-quests-all-wrap .sc_current_save_profile').addClass('saved')
        $('#scs-ui-quests-all-wrap .sc_current_save_profile_btn').attr('src', save_cancel_icon)
    } else {
        $('#scs-ui-quests-all-wrap .sc_current_save_profile').removeClass('saved')
        $('#scs-ui-quests-all-wrap .sc_current_save_profile_btn').attr('src', save_icon)
    }

    // For questionaire test cards
    $('#sc-ui-testsquests-all-wrap .sc_current_save_profile').attr('data-lesson', dataid)
    let saved_untakenTests = window.localStorage.getItem('saved_untakenTests')
    saved_untakenTests = saved_untakenTests ? JSON.parse(saved_untakenTests) : []

    if (saved_untakenTests.findIndex(themeId => themeId == dataid) != -1) {
        $('#sc-ui-testsquests-all-wrap .sc_current_save_profile').addClass('saved')
        $('#sc-ui-testsquests-all-wrap .sc_current_save_profile_btn').attr('src', save_cancel_icon)
    } else {
        $('#sc-ui-testsquests-all-wrap .sc_current_save_profile').removeClass('saved')
        $('#sc-ui-testsquests-all-wrap .sc_current_save_profile_btn').attr('src', save_icon)
    }
}

function sc_onPointerDown({ clientX, clientY }) {
    sc_startX = clientX
    sc_startY = clientY
    var sc_current = document.querySelector(current_cards + ' .sc-current-card')

    sc_current.addEventListener('pointermove', sc_onPointerMove)
    sc_current.addEventListener('pointerup', sc_onPointerUp)
    // for mobiles PointerUp for swipe function and for desktop PointerLeave for doing nothing
    if (sc_frame.clientWidth <= 655) {
        sc_current.addEventListener('pointerleave', sc_onPointerUp)
    } else {
        sc_current.addEventListener('pointerleave', sc_onPointerUp)
    }
}

function sc_onPointerMove(e) {
    var sc_current = document.querySelector(current_cards + '.sc-current-card')

    sc_moveX = e.clientX - sc_startX
    sc_moveY = e.clientY - sc_startY

    sc_setTransform(sc_moveX, sc_moveY, (sc_moveX / innerWidth) * 50)
}

function sc_onPointerUp() {
    var sc_current = document.querySelector(current_cards + '.sc-current-card')

    sc_current.removeEventListener('pointermove', sc_onPointerMove)
    sc_current.removeEventListener('pointerup', sc_onPointerUp)
    sc_current.removeEventListener('pointerleave', sc_onPointerUp)

    var sc_divi = 8
    if (sc_frame.clientWidth <= 655) {
        sc_divi = 8
    }

    if (Math.abs(sc_moveX) > sc_frame.clientWidth / sc_divi) {
        sc_current.removeEventListener('pointerdown', sc_onPointerDown)
        sc_complete()
        sc_moveX = 0
    } else {
        if (sc_moveY <= -10) {
            sc_moveX = 0
            sc_moveY = 0
            sc_complete()
        } else {
            sc_cancel()
            sc_current.querySelector('.is-like').classList = 'is-like'
        }
    }
}

$(document).on('click', '.sc-yes-swipe-right', function () {
    sc_moveX = 1
    sc_moveY = 0
    sc_complete()
})
$(document).on('click', '.sc-no-swipe-left', function () {
    sc_moveX = -1
    sc_moveY = 0
    sc_complete()
})
$(document).on('click', '.sc-idk-swipe-up', function () {
    sc_moveX = 0
    sc_moveY = 0
    sc_complete()
})
$(document).on('click', '.sc-back-btn', function () {
    sc_moveX = -2
    sc_moveY = 0
    sc_complete()
})

function sc_complete() {
    // Adding loader for 3ms
    $('html').addClass('loading')

    var sc_cardlist_noneed_html = ''
    $('.sc_noneed').remove()

    if (sc_moveX == -2) {
        var sc_totalchk_new = 0
        const sc_cards = document.querySelectorAll(
            current_cards + '.sc-ui-quests-card'
        )
        sc_totalchk_new = sc_cards.length
        // Temp Solution for Category Card Back Button not working starts
        if (
            document.querySelector(current_all_wrap + '.sc-back-btn').style.cursor ==
            'inherit'
        ) {
            $('html').removeClass('loading')
            return false
        }
        // Temp Solution for Category Card Back Button not working ends
        if (sc_totalchk == sc_totalchk_new) {
            // Temp Solution for Category Card Back Button not working starts
            var sc_newNode = sc_back_htmlque_html[sc_back_htmlque_html.length - 1]
            const sc_list = document.querySelector(current_cards)

            sc_beforeInsertRemoveQue()
            sc_list.insertBefore(sc_newNode, sc_list.children[0])

            var sc_current2 = document.querySelector(
                current_cards + '.sc-current-card'
            )
            sc_initCard(sc_current2)

            setTimeout(function () {
                sc_current2.style.transform = `translate3d(0px, 0px, 0px) rotate(0deg)`
                sc_current2.style.transition = `transform 500ms`
            }, 1)

            sc_back_htmlque_html.pop()
            sc_totalact--
            // Temp Solution for Category Card Back Button not working ends
        } else {
            var sc_newNode = sc_back_htmlque_html[sc_back_htmlque_html.length - 1]
            const sc_list = document.querySelector(current_cards)

            sc_beforeInsertRemoveQue()
            sc_list.insertBefore(sc_newNode, sc_list.children[0])

            var sc_current2 = document.querySelector(
                current_cards + '.sc-current-card'
            )
            sc_initCard(sc_current2)

            setTimeout(function () {
                sc_current2.style.transform = `translate3d(0px, 0px, 0px) rotate(0deg)`
                sc_current2.style.transition = `transform 500ms`
            }, 1)

            sc_back_htmlque_html.pop()
            sc_totalact--
        }
        if (sc_back_htmlque_html.length == 0) {
            document.querySelector(current_all_wrap + '.sc-back-btn').style.opacity =
                '0.5'
            document.querySelector(current_all_wrap + '.sc-back-btn').style.cursor =
                'inherit'
        } else {
            document.querySelector(current_all_wrap + '.sc-back-btn').style.opacity =
                '1'
            document.querySelector(current_all_wrap + '.sc-back-btn').style.cursor =
                'pointer'
        }

        // Cards Progress bar starts here
        let total_answers = parseInt($.trim($(current_all_wrap + '.sc-cards-progress-bar .tq-progress-total-cards').text()))
        let answer_no = parseInt($.trim($(current_all_wrap + '.sc-cards-progress-bar .tq-progress-card-no').text()))

        $(current_all_wrap + '.sc-cards-progress-bar .tq-progress-card-no').text(
            answer_no - 1
        )
        let progress_width = ((answer_no - 1) / total_answers) * 100
        $(current_all_wrap + '.sc-cards-progress-bar .tq-progress-bar-inner').css('width', progress_width + '%')
        // Cards Progress bar ends here

        no_answer_count--

        // Adding loader for 3ms
        $('html').removeClass('loading')

        // Remove z-index9999 class from card if back button pressed. With moving, card has z-index999 class.
        sc_current2.classList.remove('z-index9999')
    } else {
        if (sc_moveX == 0 && sc_moveY == 0) {
            var flyX = 0
            var flyY = -3000
            sc_setTransform(flyX, flyY, 0, innerWidth)
            var answer = 'unknow'
            document
                .querySelector('.sc-idk-swipe-up')
                .classList.add('form-btn-highlighter')
        } else {
            var flyX = (Math.abs(sc_moveX) / sc_moveX) * innerWidth * 1.3
            var flyY = (sc_moveY / sc_moveX) * flyX
            var answer = ''
            if (flyX > 0) {
                answer = 'yes'
                document.querySelector('.sc-yes-swipe-right').classList.add('form-btn-highlighter')

                // if user is on subcategory posts then save lesson on each swipe yes
                if (current_cards === "#scs-ui-quests-cards-wrap ") {
                    let save_btn = $("#scs-ui-quests-all-wrap .sc_current_save_profile");
                    let save_action = "only_save_no_unsave";
                    process_save_lessons(save_btn, save_action);
                }

                // If user has swiped the test card as 'Yes' then redirect user to questionaire page.
                if (current_all_wrap === "#sc-ui-testsquests-all-wrap ") {
                    var sc_current = $(current_cards + '.sc-current-card');
                    window.setInterval(function () {
                        $('html').addClass('loading')
                    })
                    window.location.href = rlghData.siteUrl + '/category/' + sc_current.attr('data-category') + '?questionaire=true&returnUrl=' + window.location.href;
                }

            } else {
                answer = 'no'
                no_answer_count++
                document.querySelector('.sc-no-swipe-left').classList.add('form-btn-highlighter')
                // Hidning sub categories button answered as No (buttons are on next screen after sub categories cards)
                $('.cat-subpostbtn-' + document.querySelector(current_cards + '.sc-current-card').getAttribute('data-postid')).css('display', 'none')
            }
            if (innerWidth < 767) {
                innerWidth = 1200
            }
            sc_setTransform(flyX, flyY, (flyX / innerWidth) * 50, innerWidth);
        }

        // remove tunnel buttons for tunnel cards no or idk
        if (
            (answer === 'yes' || answer === 'unknow') &&
            current_all_wrap == '#sc-ui-tunnelquests-all-wrap '
        ) {
            var sc_current = $(current_cards + '.sc-current-card')
            $('.cat-tunnelbtn-' + sc_current.attr('data-mainpostid')).css(
                'display',
                'flex'
            )
        }
        // show test screen for tunnel cards idk
        if (
            answer == 'unknow' &&
            current_all_wrap == '#sc-ui-tunnelquests-all-wrap '
        ) {
            $(current_all_wrap).fadeOut(function () {
                var sc_current = $(current_cards + '.sc-current-card')
                $('#sct-test-new-category-text').text(
                    sc_current.find('.sc-ui-card-quest').text()
                )
                $('#sct-test-new-category-button').attr(
                    'href',
                    rlghData.siteUrl +
                    '/category/' +
                    sc_current.attr('data-category') +
                    '?questionaire=true&returnUrl=' +
                    window.location.href
                )

                $('#sct-category-test-wrap')
                    .fadeIn()
                    .css('display', 'flex')
            })
        }

        let total_answers = parseInt(
            $.trim(
                $(
                    current_all_wrap + '.sc-cards-progress-bar .tq-progress-total-cards'
                ).text()
            )
        )
        let answer_no = parseInt(
            $.trim(
                $(
                    current_all_wrap + '.sc-cards-progress-bar .tq-progress-card-no'
                ).text()
            )
        )

        // Cards Progress bar starts here
        if (answer_no !== total_answers) {
            $(current_all_wrap + '.sc-cards-progress-bar .tq-progress-card-no').text(
                answer_no + 1
            )
            let progress_width = ((answer_no + 1) / total_answers) * 100
            $(current_all_wrap + '.sc-cards-progress-bar .tq-progress-bar-inner').css(
                'width',
                progress_width + '%'
            )
        }
        // Cards Progress bar ends here

        // Removing answers buttons highlighter after one second
        setTimeout(function () {
            document.querySelectorAll('.multi-btn li').forEach(e => {
                e.classList.remove('form-btn-highlighter')
            })
        }, 1000)

        sc_totalact++

        setTimeout(function () {
            var sc_cdiv = document.querySelector(current_cards + ' .sc-current-card')
            sc_back_htmlque_html.push(sc_cdiv)
            sc_rearrange_card_order()
            var sc_cardList = document.querySelectorAll(
                current_cards + '.sc-ui-quests-card'
            )
            if (sc_cardList.length == 1) {
                sc_cardlist_noneed_html =
                    '<div class="sc-ui-quests-card sc-show-cards sc_noneed" style="order: 1;background:transparent;"></div><div class="sc-ui-quests-card sc-show-cards sc_noneed" style="order: 3;background:transparent;"></div>'
                document.querySelector(
                    current_cards
                ).innerHTML += sc_cardlist_noneed_html
            } else if (sc_cardList.length == 2) {
                sc_cardlist_noneed_html =
                    '<div class="sc-ui-quests-card sc-show-cards sc_noneed" style="order: 3;background:transparent;"></div>'
                document.querySelector(
                    current_cards
                ).innerHTML += sc_cardlist_noneed_html
            } else if (sc_cardList.length == 0) {
                $('.sc-ui-screen-second, .sc-ui-screen-fifth').fadeOut(function () {

                    let all_btn_done = true
                    $('.sc-ui-sub-cat-btn').each(function () {
                        if ($(this).css('display') === 'flex') {
                            all_btn_done = false
                        }
                    })

                    if (all_btn_done === false) {

                        if (current_cards == '#scs-ui-quests-cards-wrap ') {
                            // for sub categories posts, if swiped all cards for one subcat, put all cards back so that if user selects aa=gain, system can show him cards again
                            $(current_cards).html(sub_cat_all_posts)
                        }

                        if (crnt_subcat_posts_saved_strategies_count !== 0) {
                            // if user has saved some strategies, then show him Screen Inviting users to comlpete exrcise after each saved strategy that have exercide content
                            $('.sc-ui-screen-fifth-exercise-info').fadeIn();

                        } else if (yes_answer_arr.length !== 0) {
                            // show set reminder screen for each saved strategy in a select dropdown

                            // first remove previous append data and add default option
                            $('.saved-strategies-dropdown-to-set-reminders').html('<option value="" selected="" disabled="">Select Strategy</option>');

                            // append new saved strategies
                            yes_answer_arr.forEach(function (strategy) {
                                $('.saved-strategies-dropdown-to-set-reminders').append('<option value=' + strategy.id + '>' + strategy.title + '</option>');
                            });
                            $(".sc-set-reminders-for-saved-strategies-screen").fadeIn();

                        } else {
                            // if user has not saved any strategies, then show him Screen with sub category buttons
                            $('.sc-ui-screen-third').fadeIn()
                            crnt_subcat_posts_saved_strategies_count = 0
                            $('.sc-ui-strategies-btns').html('')
                        }

                    } else if (current_cards === '#sc-ui-quests-cards-wrap ') {

                        // remove all strategies cards from section
                        $(current_cards).html(' ')

                        if (no_answer_count === total_answers) {
                            // user answered aal main subcategories as No, then show him directly the tunnel cards
                            // $('.sc-ui-screen-sixth').fadeIn()
                        }
                        $('.sc-ui-screen-sixth').fadeIn()

                    } else if (current_cards === '#scs-ui-quests-cards-wrap ') {
                        // if all strategies in subcategories are finished, show user the tunnel screen
                        $('.sc-ui-screen-sixth').fadeIn()

                    } else if (current_cards === '#sc-ui-tunnelquests-cards-wrap ') {
                        // if Tunnel test screen is not visible then show finished info
                        $(current_all_wrap).fadeOut(function () {
                            if ($('#sct-category-test-wrap').css('display') !== 'flex') {
                                if (no_answer_count === total_answers) {
                                    $('#sc_finished_info').fadeIn()
                                } else {
                                    $('#sct-tunnel-all-buttons').fadeIn()
                                }
                            }
                        })
                    }
                })
            }

            if (document.querySelector(current_cards + '.sc-current-card')) {
                var sc_current = document.querySelector(
                    current_cards + '.sc-current-card'
                )
                sc_initCard(sc_current)
            }

            // Removing loader
            $('html').removeClass('loading')
        }, 500)
    }
}

// Third Screen with cat sub buttons
$(document).on('click', '.sc-ui-sub-cat-btn', function () {
    var crnt = $(this)
    crnt.fadeOut()
    let selected_post_id = crnt.attr('data-subpostid')
    $('#scs-ui-quests-cards-wrap .sc-ui-quests-card').each(function () {
        if ($(this).attr('data-mainpostid') !== selected_post_id) {
            $(this).remove()
        }
    })

    // setting progress bar total numbers and width
    // Get data-postforthis_subcat from remaining cards (remaining are selected) and get maximum number for total
    let total_posts = 0
    $('#scs-ui-quests-cards-wrap .sc-ui-quests-card').each(function () {
        if (parseInt($(this).attr('data-postforthis_subcat')) > total_posts) {
            total_posts = $(this).attr('data-postforthis_subcat')
        }
    })
    $('#scs-ui-quests-all-wrap .tq-progress-card-no').text('1')
    $('#scs-ui-quests-all-wrap .tq-progress-total-cards').text(total_posts)
    $('#scs-ui-quests-all-wrap .tq-progress-bar-blue').css(
        'width',
        (1 / parseInt(total_posts)) * 100 + '%'
    )

    current_cards = '#scs-ui-quests-cards-wrap '
    current_all_wrap = '#scs-ui-quests-all-wrap '
    sc_current = document.querySelector(current_cards + '.sc-current-card')
    sc_back_htmlque_html = new Array()
    sc_frame = document.getElementById('scs-ui-quests-cards-wrap')
    no_answer_count = 0

    sc_rearrange_card_order()

    $('.sc-ui-screen-third').fadeOut(function () {
        $('.sc-new-sub-category-strategies').text(crnt.attr('data-subcat'))
        $('.sc-ui-screen-fourth').fadeIn()
    })
})

$(document).on('click', '.sc-show-sub-cat-strategies', function () {
    var crnt = $(this)

    crnt.parents('.sc-ui-design').fadeOut(function () {
        // again show cards with selected sub category
        crnt.parents('.sc-ui-design').next('.sc-ui-design').fadeIn();
        // show card tutorial
        const showCardsTutorial = window.localStorage.getItem('show_cards_tutorial')
        if (showCardsTutorial == 'no') {
            $('#za_category_page').removeClass('za-show-card-tutorial1')
        } else {
            $('#za_category_page').addClass('za-show-card-tutorial1')
            let count = 1
            $('.wellbeing-category-page').click(function () {
                if (count == 1) {
                    $('#za_category_page').removeClass('za-show-card-tutorial1')
                    $('#za_category_page').addClass('za-show-card-tutorial2')
                    count++
                } else {
                    $('#za_category_page').removeClass('za-show-card-tutorial2')
                    window.localStorage.setItem('show_cards_tutorial', 'no')
                    // Save Data to database
                    if ($("body").hasClass('logged-in')) {
                        saveLocalStorageDataToDB('show_cards_tutorial')
                    }
                }
            })
        }
    })
})

$(document).on('click', '.sc-ui-jsplay-video', function () {
    var crnt = $(this)
    if (crnt.parents('.sc-ui-quests-card').hasClass('moving') || !crnt.parents('.sc-ui-quests-card').hasClass('sc-current-card')) {
        return false
    }

    let datayoutube = crnt.parents('.sc-ui-quests-card').attr("data-ytvideo");
    let contact_autoplay_video = '?autoplay=1'
    if (datayoutube.indexOf('?') >= 0) {
        contact_autoplay_video = '&autoplay=1'
    }
    datayoutube = datayoutube + contact_autoplay_video

    crnt.parents('.sc-ui-quests-card').find(".sc-ui-card-video iframe").attr("src", datayoutube)
    crnt.parents('.sc-ui-quests-card').addClass('sc-ui-card-video-shown')
})

$(document).on('click', '.sc-ui-jsclose-video', function () {
    var crnt = $(this)
    var popup = document.querySelector('.sc-ui-card-video')
    popupVideo(popup, 'pause')
    $(".sc-ui-card-video iframe").attr("src", "")

    crnt.parents('.sc-ui-quests-card').removeClass('sc-ui-card-video-shown')
})

$(document).on('click', '#scs-ui-quests-all-wrap .sc-ui-card-quest-content', function () {
    var crnt = $(this)
    if (
        crnt.parents('.sc-ui-quests-card').hasClass('moving') ||
        !crnt.parents('.sc-ui-quests-card').hasClass('sc-current-card')
    ) {
        return false
    }

    let iframe_link = crnt.parents('.sc-ui-quests-card').attr("data-ytvideo");
    let title = crnt.parents('.sc-ui-quests-card').find('.sc-ui-card-quest').text()
    let description = crnt.parents('.sc-ui-quests-card').find('.sc-ui-card-quest-desc').html()
    let test_link = rlghData.siteUrl + '/' + crnt.parents('.sc-ui-quests-card').attr('data-category') + '?questionaire=true';
    $('#popup_category_video_link').attr('src', iframe_link)
    $('#popup_category_title').html(title)
    $('#popup_category_text').html(description)
    $('.video-popup-new #data_other').html(
        crnt.parents('.sc-ui-quests-card').find('.sc-ui-other-resources').html()
    )

    let reminder_link = $(".js-start-reminder-btn").attr("href") + crnt.parents('.sc-ui-quests-card').attr('data-postid');
    $(".js-start-reminder-btn").attr("href", reminder_link);

    if (crnt.find('.sc-ui-post-exerices-content').length !== 0) {
        $('.js-show-start-exercise-screen').css('display', 'flex')
        $('.js-show-start-exercise-screen').attr('data-targetcards', 'scCards')
    } else {
        $('.js-show-start-exercise-screen').css('display', 'none')
    }

    var popup = document.querySelector('.video-popup-new')
    popup.classList.add('show')

    lockScroll()
    const close_btn = popup.querySelector('.close-video-popup-new')
    close_btn.addEventListener('click', function () {
        popupVideo(popup, 'pause')
        popup.classList.remove('show')
        unlockScroll()
    })
})

$(document).on('click', '.js-show-other-resourse', function () {
    var crnt = $(this)

    $('#popup_category_video_link').attr(
        'src',
        crnt.find('.other_resource_video').attr('datayoutube')
    )
    $('#popup_category_title').html(crnt.attr('title'))
    $('#popup_category_text').html(crnt.find('.data_resource_description').html())
})

$(document).on('click', '.scs-show-tunnelquestions', function () {
    var crnt = $(this)

    $('.sc-ui-screen-sixth').fadeOut(function () {
        current_cards = '#sc-ui-tunnelquests-cards-wrap '
        current_all_wrap = '#sc-ui-tunnelquests-all-wrap '
        sc_current = document.querySelector(current_cards + '.sc-current-card')
        sc_back_htmlque_html = new Array()
        sc_frame = document.getElementById('sc-ui-tunnelquests-cards-wrap')
        no_answer_count = 0
        sc_rearrange_card_order()

        $('.sc-ui-screen-seventh').fadeIn()
    })
})

$(document).on('click', '#sct-test-current-category-button', function () {
    var crnt = $(this)

    $('.cp-category-suggestion-wrap').fadeOut(function () {
        var sc_cardList = document.querySelectorAll(
            current_cards + '.sc-ui-quests-card'
        )
        if (sc_cardList.length !== 0) {
            $(current_all_wrap).fadeIn()
        } else {
            $('#sct-tunnel-all-buttons').fadeIn()
        }
    })
})

$(document).on('click', '.scs-finish-category', function () {
    var crnt = $(this)

    crnt.parents('.sc-ui-design').fadeOut(function () {
        $('#sc_finished_info').fadeIn()
    })
})

function sc_setTransform(x, y, deg, duration) {
    var sc_current = document.querySelector(current_cards + '.sc-current-card')
    $('.sc-ui-quests-card').removeClass('z-index9999')
    if (x !== 0 || y !== 0) {
        sc_current.classList.add('moving')
        sc_current.classList.add('z-index9999')
    } else {
        window.setTimeout(function () {
            sc_current.classList.remove('moving')
        }, 300)
        sc_current.classList.remove('z-index9999')
    }
    sc_current.style.transform = `translate3d(${x}px, ${y}px, 0) rotate(${deg}deg)`
    const likeText = sc_current.querySelector('.is-like')
    if (typeof likeText !== 'undefined') {
        if (x < 0 && Math.abs(y) < Math.abs(x)) {
            likeText.className = `is-like nope`
        } else if (x > 0 && Math.abs(y) < Math.abs(x)) {
            likeText.className = `is-like yes`
        } else if (y < 0) {
            likeText.className = `is-like idk`
        }
    }

    if (duration) sc_current.style.transition = `transform ${duration}ms`
}


$(document).on('submit', '.show-target-post-for-set-reminder', function (e) {
    e.preventDefault();
    let crnt = $(this);

    window.open(rlghData.siteUrl + '/reminder/?post_id=' + crnt.find('.saved-strategies-dropdown-to-set-reminders').val());
});

$(document).on('click', '.js-hide-finished-and-show-set-reminder-screen', function (e) {
    // this is for que-list-box cards

    e.preventDefault();
    let crnt = $(this);

    $("#finished_info").fadeOut(function () {
        if (yes_answer_arr.length !== 0) {
            // show set reminder screen for each saved strategy in a select dropdown
            // first remove previous append data and add default option
            $('.saved-strategies-dropdown-to-set-reminders').html('<option value="" selected="" disabled="">Select Strategy</option>');

            // append new saved strategies
            yes_answer_arr.forEach(function (strategy) {
                $('.saved-strategies-dropdown-to-set-reminders').append('<option value=' + strategy.id + '>' + strategy.title + '</option>');
            });
            $(".sc-set-reminders-for-saved-strategies-screen").fadeIn();
        }
    });
});

$(document).on('click', '.js-hide-reminder-screen-and-show-cards', function (e) {

    $(".sc-set-reminders-for-saved-strategies-screen").fadeOut(function () {
        if (document.querySelector('.que-list-sec')) {

            // Request coming from original que-list-box cards
            $("#finished_info").fadeIn();

        } else {

            // Request coming from subcategiry design
            let all_btn_done = true
            $('.sc-ui-sub-cat-btn').each(function () {
                if ($(this).css('display') === 'flex') {
                    all_btn_done = false
                }
            })

            if (all_btn_done === false) {
                // here current cards are scs-ui-quests-cards
                $(current_cards).html(sub_cat_all_posts);
                crnt_subcat_posts_saved_strategies_count = 0
                $(".sc-ui-screen-third").fadeIn();
            } else {
                $('.sc-ui-screen-sixth').fadeIn()
            }

        }

        yes_answer_arr = new Array();
    });
})


$(document).on('click', '.js-skip-cards', function (e) {
    e.preventDefault();

    let crnt = $(this);


    if (crnt.attr('data-target') === 'show_finished_category_info_from_que_list_box') {

        $("#que_list_sec").fadeOut(function () {
            $("#finished_info").fadeIn();
        })

    } else if (crnt.attr('data-target') === 'show_my_progress_main_page') {
        // skipp all tests cards on my progress page
        $("#sc-ui-testsquests-all-wrap").fadeOut(function () {
            $('.single-main-content').fadeIn();
        })

    } else if (crnt.attr('data-target') === 'show_all_subcategory_btns') {
        // skipp all question cards of subcategory 
        $("#scs-ui-quests-all-wrap").fadeOut(function () {

            if (crnt_subcat_posts_saved_strategies_count !== 0) {
                // if user has saved some strategies, then show him Screen Inviting users to comlpete exrcise after each saved strategy that have exercide content
                $('.sc-ui-screen-fifth-exercise-info').fadeIn();
            } else if (yes_answer_arr.length !== 0) {
                // show set reminder screen for each saved strategy in a select dropdown

                // first remove previous append data and add default option
                $('.saved-strategies-dropdown-to-set-reminders').html('<option value="" selected="" disabled="">Select Strategy</option>');

                // append new saved strategies
                yes_answer_arr.forEach(function (strategy) {
                    $('.saved-strategies-dropdown-to-set-reminders').append('<option value=' + strategy.id + '>' + strategy.title + '</option>');
                });
                $(".sc-set-reminders-for-saved-strategies-screen").fadeIn();

            } else {
                // if user has not saved any strategies, then show him Screen with sub category buttons
                $('.sc-ui-screen-third').fadeIn()
                crnt_subcat_posts_saved_strategies_count = 0
                $('.sc-ui-strategies-btns').html('')

                let all_btn_done = true
                $('.sc-ui-sub-cat-btn').each(function () {
                    if ($(this).css('display') === 'flex') {
                        all_btn_done = false
                    }
                })

                if (all_btn_done === false) {
                    // here current cards are scs-ui-quests-cards
                    $(current_cards).html(sub_cat_all_posts);
                    $(".sc-ui-screen-third").fadeIn();
                } else {
                    $(".sc-ui-screen-third").css('display', 'none');
                    $('.sc-ui-screen-sixth').fadeIn()
                }

            }

        });
    } else if (crnt.attr('data-target') === 'show_finished_category_info') {
        // skipp all tunnel cards
        $("#sc-ui-tunnelquests-all-wrap").fadeOut(function () {
            $('#sc_finished_info').fadeIn()
        });

    }
})

function sc_cancel() {
    var sc_current = document.querySelector(current_cards + '.sc-current-card')
    sc_setTransform(0, 0, 0, 100)
    setTimeout(() => (sc_current.style.transition = ''), 100)
}

// Exercises Code

$(document).on('click', '.js-show-start-exercise-screen', function () {
    var crnt = $(this)

    unlockScroll()
    $('.video-popup-new').removeClass('show')

    if (crnt.attr('data-targetcards') === 'queListBox') {
        // que-list-box cards
        $("#que_list_sec").fadeOut(function () {
            $('.sc-exercies-wrap .sc-exercise-category').html(
                $('#za_category_page').attr('data-category')
            )
            $('.sc-exercies-wrap .sc-exercise-title').html(
                $('.que-list-box.current-que').find('.question h2').html()
            )
            $('.sc-exercies-wrap .sc-exercise-description').html(
                $('.que-list-box.current-que').find('.card-description').html()
            )
            $('.sc-exercies-wrap .sc-exercise-strategy').html(
                $('.que-list-box.current-que').find('.question h2').text()
            )
            $('.sc-exercies-wrap .sc-exercise-strategy').attr(
                'href',
                $('.que-list-box.current-que').find('.question h2').attr('data-postlink')
            )
            let template_name = $.trim($('.que-list-box.current-que').find(".sc-ui-post-exerices-template").text());
            $("#" + template_name).css("display", "block");

            // setting post details on exercise form
            $('#' + template_name + ' form').attr('data-postid', $('.que-list-box.current-que').attr('data-id'))
            $('#' + template_name + ' form').attr('data-posttitle', $('.que-list-box.current-que').find('.question h2').html())
            $('#' + template_name + ' form').attr('data-postlink', $('.que-list-box.current-que').find('.question h2').attr('data-postlink'))

            $('.sc-exercies-wrap').fadeIn()
        });

    } else {
        // Sleep better cards

        $('.sc-ui-design').fadeOut(function () {
            $('.sc-exercies-wrap .sc-exercise-category').html(
                $('#za_category_page').attr('data-category')
            )
            $('.sc-exercies-wrap .sc-exercise-title').html(
                $(current_cards + '.sc-current-card').find('.sc-ui-post-exerices-title').html()
            )
            $('.sc-exercies-wrap .sc-exercise-description').html(
                $(current_cards + '.sc-current-card').find('.sc-ui-post-exerices-description').html()
            )
            $('.sc-exercies-wrap .sc-exercise-strategy').html(
                $(current_cards + '.sc-current-card').find('.sc-ui-card-quest').text()
            )
            $('.sc-exercies-wrap .sc-exercise-strategy').attr(
                'href',
                $(current_cards + '.sc-current-card').find('.sc-ui-card-quest').attr('data-permalink')
            )
            let template_name = $.trim($(".sc-ui-quests-card .sc-ui-post-exerices-template").text());
            $("#" + template_name).css("display", "block");

            // setting post details on exercise form
            $('#' + template_name + ' form').attr('data-postid', $(current_cards + '.sc-current-card').attr('data-postid'))
            $('#' + template_name + ' form').attr('data-posttitle', $(current_cards + '.sc-current-card').find('.sc-ui-card-quest').text())
            $('#' + template_name + ' form').attr('data-postlink', $(current_cards + '.sc-current-card').find('.sc-ui-card-quest').attr('data-permalink'))


            $('.sc-exercies-wrap').fadeIn();

        })
    }

})


// show exercise screen from Exercise invite screen if user have saved some strategies

$(document).on('click', '.js-show-exercise-screen', function () {
    var crnt = $(this)

    $('.sc-ui-design').fadeOut(function () {
        $('.sc-exercies-wrap .sc-exercise-category').html(
            $('#za_category_page').attr('data-category')
        )
        $('.sc-exercies-wrap .sc-exercise-title').html(
            crnt.find('.scbtn-exercise-title').html()
        )
        $('.sc-exercies-wrap .sc-exercise-description').html(
            crnt.find('.scbtn-exercise-description').html()
        )
        $('.sc-exercies-wrap .sc-exercise-strategy').html(
            crnt.find('.scbtn-strategy').text()
        )
        $('.sc-exercies-wrap .sc-exercise-strategy').attr(
            'href',
            crnt.find('.scbtn-strategy').attr('data-permalink')
        )
        let template_name = $.trim($(".scbtn-exercise-template").text());
        $("#" + template_name).css("display", "block");
        $('.sc-exercies-wrap').fadeIn()


        // setting attribute so that if user closes the exercise screen, he can come back to target
        $('.js-show-start-exercise-screen').attr('data-targetcards', 'exercise_invite_screen_on_sc_cards')
    })
})


$(document).on('click', '.js-show-start-exercise-screen-on-singlepost', function () {
    var crnt = $(this)

    $('.welbbeing-single').fadeOut(function () {
        let template_name = $.trim($(".sc-ui-post-exerices-template-on-singlepost").text());
        $("#" + template_name).css("display", "block");
        $('.sc-exercies-wrap').fadeIn()
    })
})

$(document).on('click', '.js-hide-exercise-sheet-and-show-cards', function () {

    $('.sc-exercies-wrap').fadeOut(function () {

        if ($('.js-show-start-exercise-screen').attr('data-targetcards') === 'queListBox') {
            // que-list-box cards
            $('#que_list_sec').fadeIn()
        } else if ($('.js-show-start-exercise-screen').attr('data-targetcards') === 'scCards') {
            // sub category cards
            $('#scs-ui-quests-all-wrap').fadeIn()
        } else if ($('.js-show-start-exercise-screen').attr('data-targetcards') === 'exercise_invite_screen_on_sc_cards') {
            // Exercise Invite screen on SC cards
            $('.sc-ui-screen-fifth-exercise-info').fadeIn();
        } else {
            // Single post page
            $('.welbbeing-single').fadeIn()
        }

    })

})



$(document).on('click', '.cp-exercise-skip-btn', function () {
    var crnt = $(this)

    $('.sc-ui-design').fadeOut(function () {

        if (yes_answer_arr.length !== 0) {
            // show set reminder screen for each saved strategy in a select dropdown

            // first remove previous append data and add default option
            $('.saved-strategies-dropdown-to-set-reminders').html('<option value="" selected="" disabled="">Select Strategy</option>');

            // append new saved strategies
            yes_answer_arr.forEach(function (strategy) {
                $('.saved-strategies-dropdown-to-set-reminders').append('<option value=' + strategy.id + '>' + strategy.title + '</option>');
            });
            $(".sc-set-reminders-for-saved-strategies-screen").fadeIn();

        } else {
            let all_btn_done = true
            $('.sc-ui-sub-cat-btn').each(function () {
                if ($(this).css('display') === 'flex') {
                    all_btn_done = false
                }
            })
            if (all_btn_done === false) {
                $('.sc-ui-screen-third').fadeIn()
                crnt_subcat_posts_saved_strategies_count = 0
                $('.sc-ui-strategies-btns').html('')
            } else if (current_cards === '#sc-ui-quests-cards-wrap ') {
                if (no_answer_count === total_answers) {
                    $('.sc-ui-screen-sixth').fadeIn()
                }
                $(current_cards).html(' ')
                $('.sc-ui-screen-sixth').fadeIn()
            } else if (current_cards === '#scs-ui-quests-cards-wrap ') {
                $(current_cards).html(' ')
                $('.sc-ui-screen-sixth').fadeIn()
            } else if (current_cards === '#sc-ui-tunnelquests-cards-wrap ') {
                // if Tunnel test screen is not visible then show finished info
                $(current_all_wrap).fadeOut(function () {
                    if ($('#sct-category-test-wrap').css('display') !== 'flex') {
                        if (no_answer_count === total_answers) {
                            $('#sc_finished_info').fadeIn()
                        } else {
                            $('#sct-tunnel-all-buttons').fadeIn()
                        }
                    }
                })
            }
        }

    })
})



$(document).on('submit', '.sc-exercise-sd-form', function (e) {
    e.preventDefault()

    var crnt = $(this)
    let sdcount = crnt.attr('data-sdcount')
    let situation = crnt.find('.exercise_situation').val()
    let description = crnt.find('.exercise_description').val()
    $('.sc-exercise-situations-wrap').prepend(
        '<div class="sc-exercise-situation pos-relative" data-postid=' + crnt.attr("data-postid") + ' data-posttitle="' + crnt.attr("data-posttitle") + '" data-postlink=' + crnt.attr("data-postlink") + ' >\
            <button class="button js-delete-scexercise_item blue-cross-btn" style="top:25px;">\
                <i class="icon realgh-close"></i>\
            </button>\
            <button class="button js-edit-scexercise_item blue-cross-btn" data-form="exercise_sd_form" style="top:25px;right:35px;">\
                <img src="' + rlghData.themePath + '/assets/img/category-page-icons/edit.png' + '"> \
            </button>\
        <h2 class="title sc-exercise-situation-title">' + situation +
        '</h2><p class="sc-exercise-situation-desc text">' +
        description +
        '</p></div>'
    )


    // saving data in localstorage and in database
    // Remove everything in localstorage 'exercises_sd_data' and again input all exercises
    // In this way, duplication will be prevented
    let exercises_sd_data = [];
    $(".sc-exercise-situations-wrap .sc-exercise-situation").each(function () {
        let crntt = $(this);
        exercises_sd_data.push({ "data": crntt.prop('outerHTML') });
    });
    window.localStorage.setItem('exercises_sd_data', JSON.stringify(exercises_sd_data));


    // resetting the form
    crnt.find('.exercise_situation').val('')
    crnt.find('.exercise_description').val('')
    crnt.attr('data-sdcount', parseInt(sdcount) + 1)
})


$(document).on('click', '.sc-add-exercise-t2-time-btn', function (e) {
    e.preventDefault()

    var crnt = $(this)
    let sc_exercise_t2_plan_details_form = '<div class="sc-exercise-t2-plan-details-form m-b-10"><input type="time" class="input input-text input--req sc_exercise_t2_time sc_exercise_t2_stime" name="sc_exercise_t2_stime2" required="">\
                                                <span>to</span>\
                                                <input type="time" class="input input-text input--req sc_exercise_t2_time sc_exercise_t2_etime" name="sc_exercise_t2_etime2" required="">                \
                                                <span class="sc-spacer-5"></span>                \
                                                <input type="text" placeholder="Cleaning, working, relaxing etc." class="input input-text input--req sc_exercise_t2_plan" name="sc_exercise_t2_plan2" required="">\
                                            </div>';

    $(".sc-exercise-plan-form .sc-exercise-t2-plan-details-form-area").append(sc_exercise_t2_plan_details_form)

    $('.sc-exercise-plan-form .sc-exercise-t2-plan-details-form-area').attr("data-sdcount", parseInt(form_count) + 1);
})



$(document).on('submit', '.sc-exercise-plan-form', function (e) {
    e.preventDefault()

    let crnt = $(this);
    let data = '<div class="form__cell req-field m-b-10 sc-exercise-t2-plan-details-form-wrap pos-relative" data-postid=' + crnt.attr("data-postid") + ' data-posttitle="' + crnt.attr("data-posttitle") + '" data-postlink=' + crnt.attr("data-postlink") + ' >\
                    <button class="button js-delete-scexercise_item blue-cross-btn" style="top:0px;">\
                        <i class="icon realgh-close"></i>\
                    </button>\
                    <button class="button js-edit-scexercise_item blue-cross-btn" data-form="exercise_plan_form" style="top:0px;right:35px;">\
                        <img src="' + rlghData.themePath + '/assets/img/category-page-icons/edit.png' + '"> \
                    </button>\
                    <h2 class="title col-blue text-capitalize fw-700">' + crnt.find("select.sc_exercise_t2_day").val() + '</h2>';
    $(".sc-exercise-plan-form .sc-exercise-t2-plan-details-form").each(function () {
        let crntt = $(this);
        data += '<div class="sc-exercise-t2-plan-details-form js-plan-form-styling w-100">\
                    <span class="bordered-boxshadow sc_plan_stime">' + crntt.find(".sc_exercise_t2_stime").val() + '</span>\
                    <span class="text">to</span>\
                    <span class="bordered-boxshadow sc_plan_etime">' + crntt.find(".sc_exercise_t2_etime").val() + '</span>\
                    <span class="sc-spacer-5"></span><span class="bordered-boxshadow w-100 sc_plan_text">' + crntt.find(".sc_exercise_t2_plan").val() + '</span>\
                </div>';
    });
    data += '</div>';


    $(".sc-exercise-plans-wrap").append(data);

    $(".sc-exercise-plan-form input, .sc-exercise-plan-form select").val('');


    // saving data in localstorage and in database
    // Remove everything in localstorage 'exercises_plan_data' and again input all exercises
    // In this way, duplication will be prevented
    let exercises_plan_data = [];
    $(".sc-exercise-plans-wrap .sc-exercise-t2-plan-details-form-wrap").each(function () {
        let crntt = $(this);
        exercises_plan_data.push({ "data": crntt.prop('outerHTML') });
    });
    window.localStorage.setItem('exercises_plan_data', JSON.stringify(exercises_plan_data));
})


$(document).on('submit', '.sc-exercise-journal-form', function (e) {
    e.preventDefault()

    var crnt = $(this)
    let sdcount = crnt.attr('data-sdcount')
    let journal_date = crnt.find('.sc_exercise_journal_date').val()
    let journal_thoughts = crnt.find('.sc_exercise_journal_thoughts').val()
    $('.sc-journal-details-wrap').prepend(
        '<div class="sc-journal-details pos-relative" data-postid=' + crnt.attr("data-postid") + ' data-posttitle="' + crnt.attr("data-posttitle") + '" data-postlink=' + crnt.attr("data-postlink") + ' >\
            <button class="button js-delete-scexercise_item blue-cross-btn" style="top:15px;">\
                <i class="icon realgh-close"></i>\
            </button>\
            <button class="button js-edit-scexercise_item blue-cross-btn" data-form="exercise_journal_form" style="top:15px;right:35px;">\
                <img src="' + rlghData.themePath + '/assets/img/category-page-icons/edit.png' + '"> \
            </button>\
            <h2 class="title sc-journal-date">' + journal_date + '</h2>\
            <p class="sc-exercise-situation-desc text">' + journal_thoughts + '</p>\
        </div>'
    )

    crnt.find('.sc_exercise_journal_date').val('')
    crnt.find('.sc_exercise_journal_thoughts').val('')
    crnt.attr('data-sdcount', parseInt(sdcount) + 1)


    // saving data in localstorage and in database
    // Remove everything in localstorage 'exercises_journal_data' and again input all exercises
    // In this way, duplication will be prevented
    let exercises_journal_data = [];
    $(".sc-journal-details-wrap .sc-journal-details").each(function () {
        let crntt = $(this);
        exercises_journal_data.push({ "data": crntt.prop('outerHTML') });
    });
    window.localStorage.setItem('exercises_journal_data', JSON.stringify(exercises_journal_data));
})


$(document).on('submit', '.sc-exercise-sr-form', function (e) {
    e.preventDefault()

    var crnt = $(this)
    let sdcount = crnt.attr('data-sdcount')
    let situation = crnt.find('.exercise_t4_situation').val()
    let reflection = crnt.find('.exercise_t4_reflection').val()
    $('.sc-exercise-situationsreflections-wrap').prepend(
        '<div class="sc-exercise-situationreflection pos-relative" data-postid=' + crnt.attr("data-postid") + ' data-posttitle="' + crnt.attr("data-posttitle") + '" data-postlink=' + crnt.attr("data-postlink") + ' >\
            <button class="button js-delete-scexercise_item blue-cross-btn" style="top:5px;">\
                <i class="icon realgh-close"></i>\
            </button>\
            <button class="button js-edit-scexercise_item blue-cross-btn" data-form="exercise_sr_form" style="top:5px;right:35px;">\
                <img src="' + rlghData.themePath + '/assets/img/category-page-icons/edit.png' + '"> \
            </button>\
        <p class="sc-exercise-situation-desc sc-exercise-s text">' +
        situation +
        '</p><p class="sc-exercise-situation-desc sc-exercise-r text">' +
        reflection +
        '</p></div>'
    )

    crnt.find('.exercise_t4_situation').val('')
    crnt.find('.exercise_t4_reflection').val('')
    crnt.attr('data-sdcount', parseInt(sdcount) + 1)


    // saving data in localstorage and in database
    // Remove everything in localstorage 'exercises_sr_data' and again input all exercises
    // In this way, duplication will be prevented
    let exercises_sr_data = [];
    $(".sc-exercise-situationsreflections-wrap .sc-exercise-situationreflection").each(function () {
        let crntt = $(this);
        exercises_sr_data.push({ "data": crntt.prop('outerHTML') });
    });
    window.localStorage.setItem('exercises_sr_data', JSON.stringify(exercises_sr_data));
})



// Showing existing data if saved earlier

if ($("#sc-exercies-wrap")) {

    // exercise_sd_data
    var exercises_sd_data_str = window.localStorage.getItem('exercises_sd_data');
    if (exercises_sd_data_str) {
        var exercises_sd_data = JSON.parse(exercises_sd_data_str);
        $.each(exercises_sd_data, function (index, item) {
            var data = item.data;
            $('.sc-exercise-situations-wrap').append(data);
        });
    }

    // exercises_plan_data
    var exercises_plan_data = window.localStorage.getItem('exercises_plan_data');
    if (exercises_plan_data) {
        var exercises_plan_data = JSON.parse(exercises_plan_data);
        $.each(exercises_plan_data, function (index, item) {
            var data = item.data;
            $('.sc-exercise-plans-wrap').append(data);
        });
    }

    // exercises_journal_data
    var exercises_journal_data = window.localStorage.getItem('exercises_journal_data');
    if (exercises_journal_data) {
        var exercises_journal_data = JSON.parse(exercises_journal_data);
        $.each(exercises_journal_data, function (index, item) {
            var data = item.data;
            $('.sc-journal-details-wrap').append(data);
        });
    }

    // exercises_sr_data
    var exercises_sr_data = window.localStorage.getItem('exercises_sr_data');
    if (exercises_sr_data) {
        var exercises_sr_data = JSON.parse(exercises_sr_data);
        $.each(exercises_sr_data, function (index, item) {
            var data = item.data;
            $('.sc-exercise-situationsreflections-wrap').append(data);
        });
    }

}

$(document).on('click', '.js-delete-scexercise_item', function (e) {
    e.preventDefault()

    var crnt = $(this)
    crnt.parent().remove();

    // Remove everything in localstorage 'exercises_sd_data' and again save all exercises

    // exercise_sd_data
    let exercises_sd_data = [];
    $(".sc-exercise-situations-wrap .sc-exercise-situation").each(function () {
        let crntt = $(this);
        exercises_sd_data.push({ "data": crntt.prop('outerHTML') });
    });
    window.localStorage.setItem('exercises_sd_data', JSON.stringify(exercises_sd_data));

    // exercises_plan_data
    let exercises_plan_data = [];
    $(".sc-exercise-plans-wrap .sc-exercise-t2-plan-details-form-wrap").each(function () {
        let crntt = $(this);
        exercises_plan_data.push({ "data": crntt.prop('outerHTML') });
    });
    window.localStorage.setItem('exercises_plan_data', JSON.stringify(exercises_plan_data));

    // exercises_journal_data
    let exercises_journal_data = [];
    $(".sc-journal-details-wrap .sc-journal-details").each(function () {
        let crntt = $(this);
        exercises_journal_data.push({ "data": crntt.prop('outerHTML') });
    });
    window.localStorage.setItem('exercises_journal_data', JSON.stringify(exercises_journal_data));

    // exercises_sr_data
    let exercises_sr_data = [];
    $(".sc-exercise-situationsreflections-wrap .sc-exercise-situationreflection").each(function () {
        let crntt = $(this);
        exercises_sr_data.push({ "data": crntt.prop('outerHTML') });
    });
    window.localStorage.setItem('exercises_sr_data', JSON.stringify(exercises_sr_data));

})


$(document).on('click', '.js-edit-scexercise_item', function (e) {
    e.preventDefault()

    var crnt = $(this);

    // exercise_sd_data
    if (crnt.attr("data-form") === "exercise_sd_form") {
        $(".sc-exercise-sd-form .exercise_situation").val(crnt.parents(".sc-exercise-situation").find(".sc-exercise-situation-title").text());
        $(".sc-exercise-sd-form .exercise_description").val(crnt.parents(".sc-exercise-situation").find(".sc-exercise-situation-desc").text());
        crnt.parents(".sc-exercise-situation").find(".js-delete-scexercise_item").click();
    } else if (crnt.attr("data-form") === "exercise_plan_form") {
        $(".sc-exercise-plan-form .sc_exercise_t2_day").val(crnt.parents(".sc-exercise-t2-plan-details-form-wrap").find(".sc_plan_day").text());
        // first remove the default form and append all the saved data
        $(".sc-exercise-t2-plan-details-form-area").html(' ');
        crnt.parents(".sc-exercise-t2-plan-details-form-wrap").find(".sc-exercise-t2-plan-details-form").each(function () {
            let crnnt = $(this);
            $(".sc-exercise-t2-plan-details-form-area").append('<div class="sc-exercise-t2-plan-details-form m-b-10">\
                <input type="time" class="input input-text input--req sc_exercise_t2_time sc_exercise_t2_stime" name="sc_exercise_t2_stime" required="" value="' + crnnt.find(".sc_plan_stime").text() + '">\
                <span>to</span>\
                <input type="time" class="input input-text input--req sc_exercise_t2_time sc_exercise_t2_etime" name="sc_exercise_t2_etime" required="" value="' + crnnt.find(".sc_plan_etime").text() + '">\
                <span class="sc-spacer-5"></span>\
                <input type="text" placeholder="Cleaning, working, relaxing etc." class="input input-text input--req sc_exercise_t2_plan" name="sc_exercise_t2_plan" required="" value="' + crnnt.find(".sc_plan_text").text() + '">\
              </div>');
        });
        crnt.parents(".sc-exercise-t2-plan-details-form-wrap").find(".js-delete-scexercise_item").click();
    } else if (crnt.attr("data-form") === "exercise_journal_form") {
        $(".sc-exercise-journal-form .sc_exercise_journal_date").val(crnt.parents(".sc-journal-details").find(".sc-journal-date").text());
        $(".sc-exercise-journal-form .sc_exercise_journal_thoughts").val(crnt.parents(".sc-journal-details").find(".sc-exercise-situation-desc").text());
        crnt.parents(".sc-journal-details").find(".js-delete-scexercise_item").click();
    } else if (crnt.attr("data-form") === "exercise_sr_form") {
        $(".sc-exercise-sr-form .exercise_t4_situation").val(crnt.parents(".sc-exercise-situationreflection").find(".sc-exercise-s").text());
        $(".sc-exercise-sr-form .exercise_t4_reflection").val(crnt.parents(".sc-exercise-situationreflection").find(".sc-exercise-r").text());
        crnt.parents(".sc-exercise-situationreflection").find(".js-delete-scexercise_item").click();
    }

})


//---Show Saved Exercises on My Progress Page starts


if (document.querySelector('.exercise-items-wrap')) {
    // exercise_sd_data
    var exercises_sd_data_str = window.localStorage.getItem('exercises_sd_data');
    if (exercises_sd_data_str) {
        var exercises_sd_data = JSON.parse(exercises_sd_data_str);
        $.each(exercises_sd_data, function (index, item) {
            let data = $(item.data);
            let output = '<a href="' + data.attr("data-postlink") + '" class="exercise-box-link">\
                            <div class="excerise-box-item">\
                                <div class="excerise-box-item-header">\
                                    <h2 class="title">Exercise</h2>\
                                </div>\
                                <div class="excerise-box-item-body">\
                                    <div class="excerise-box-item-body-content">\
                                        <h2 class="title post-title-of-exercise">' + data.attr("data-posttitle") + '</h2>\
                                    </div>\
                                </div>\
                            </div>\
                        </a>';

            $('.exercise-items').append(output);
            return false;
        });
    }

    // exercises_plan_data
    var exercises_plan_data = window.localStorage.getItem('exercises_plan_data');
    if (exercises_plan_data) {
        $(".initial-default-text").css("display", "none");
        var exercises_plan_data = JSON.parse(exercises_plan_data);
        $.each(exercises_plan_data, function (index, item) {
            let data = $(item.data);
            let output = '<a href="' + data.attr("data-postlink") + '" class="exercise-box-link">\
                            <div class="excerise-box-item">\
                                <div class="excerise-box-item-header">\
                                    <h2 class="title">Exercise</h2>\
                                </div>\
                                <div class="excerise-box-item-body">\
                                    <div class="excerise-box-item-body-content">\
                                        <h2 class="title post-title-of-exercise">' + data.attr("data-posttitle") + '</h2>\
                                    </div>\
                                </div>\
                            </div>\
                        </a>';

            $('.exercise-items').append(output);
            return false;
        });
    }

    // exercises_journal_data
    var exercises_journal_data = window.localStorage.getItem('exercises_journal_data');
    if (exercises_journal_data) {
        $(".initial-default-text").css("display", "none");
        var exercises_journal_data = JSON.parse(exercises_journal_data);
        $.each(exercises_journal_data, function (index, item) {
            let data = $(item.data);
            let output = '<a href="' + data.attr("data-postlink") + '" class="exercise-box-link">\
                            <div class="excerise-box-item">\
                                <div class="excerise-box-item-header">\
                                    <h2 class="title">Exercise</h2>\
                                </div>\
                                <div class="excerise-box-item-body">\
                                    <div class="excerise-box-item-body-content">\
                                        <h2 class="title post-title-of-exercise">' + data.attr("data-posttitle") + '</h2>\
                                    </div>\
                                </div>\
                            </div>\
                        </a>';

            $('.exercise-items').append(output);
            return false;
        });
    }

    // exercises_sr_data
    var exercises_sr_data = window.localStorage.getItem('exercises_sr_data');
    if (exercises_sr_data) {
        var exercises_sr_data = JSON.parse(exercises_sr_data);
        $.each(exercises_sr_data, function (index, item) {
            let data = $(item.data);
            let output = '<a href="' + data.attr("data-postlink") + '" class="exercise-box-link">\
                            <div class="excerise-box-item">\
                                <div class="excerise-box-item-header">\
                                    <h2 class="title">Exercise</h2>\
                                </div>\
                                <div class="excerise-box-item-body">\
                                    <div class="excerise-box-item-body-content">\
                                        <h2 class="title post-title-of-exercise">' + data.attr("data-posttitle") + '</h2>\
                                    </div>\
                                </div>\
                            </div>\
                        </a>';

            $('.exercise-items').append(output);
            return false;
        });
    }
}


// redirect user to exercise screen if user clicks any saved exercise from my progress page

if (getParameterByName('show_exercise_screen') === 'true') {
    $(".welbbeing-single").css('display', 'none');

    let template_name = $.trim($(".sc-ui-post-exerices-template-on-singlepost").text());
    $("#" + template_name).css("display", "block");
    $('.sc-exercies-wrap').css('display', 'block');
}

/*
 * ----------------Sub Category New Cards Design ends here---------------------
 * ----------------Sub Category New Cards Design ends here---------------------
 * ----------------Sub Category New Cards Design ends here---------------------
 */





/*
 * ----------------Common Functions start here---------------------
 * ----------------Common Functions start here---------------------
 * ----------------Common Functions start here---------------------
 */

function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&')
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url)
    if (!results) return null
    if (!results[2]) return ''
    return decodeURIComponent(results[2].replace(/\+/g, ' '))
}

/*
 * ----------------Common Functions end here---------------------
 * ----------------Common Functions end here---------------------
 * ----------------Common Functions end here---------------------
 */















/*
 * ----------------Category Page New Design starts here---------------------
 * ----------------Category Page New Design starts here---------------------
 * ----------------Category Page New Design starts here---------------------
 */

var nextcardinprevtunnel;
$(document).on('click', '.js-sc-ui-next-screen-btn', function (e) {
    e.preventDefault();

    let crnt = $(this);
    if (crnt.attr("data-btnaction") === "registration_page") {
        showPopup('regist');
        crnt.parents('.sc-ui-design:first').fadeOut(function () {
            crnt.parents('.sc-ui-design:first').next('.sc-ui-design').fadeIn();
        });
    } else if (crnt.attr("data-btnaction") === "payment_page") {
        if ($("body").hasClass("logged-in")) {
            $(".payment__popup .js-payment-page-text").text(crnt.attr("data-paymentPageText"));
            $(".payment__popup .js-payment-details-text").val(crnt.attr("data-paymentPageText"));
            $(".payment__popup .js-payment-page-amount").val(crnt.attr("data-paymentPageAmount"));
            $(".payment__popup #btnLblPrice").text(crnt.attr("data-paymentPageAmount"));
            showPopup('payment');
        } else {
            alert("You need to login first");
            showPopup('login');
        }
    } else if (crnt.attr("data-btnaction") === "link_to_another_website") {
        $(".za-preloaderr").css("display", "flex");
        $(".ohterwebsite__popup iframe.other_website_iframe").removeAttr("style")
        let website_link = crnt.attr("href")
        if (crnt.attr("data-openinnewtab") === "Yes") {
            window.open(website_link, '_blank');
        } else {
            if (website_link.indexOf("youtube") !== -1) {
                $(".ohterwebsite__popup iframe.other_website_iframe").addClass("iframe-youtube-video");
            } else {
                $(".ohterwebsite__popup iframe.other_website_iframe").removeClass("iframe-youtube-video");
            }
            $(".ohterwebsite__popup iframe.other_website_iframe").attr("src", website_link).on("load", function () {
                $(".za-preloaderr").css("display", "none");
                let iframe = $(".ohterwebsite__popup iframe.other_website_iframe").contents();
                iframe.find('#wpadminbar, header, footer').hide();
                iframe.find('html, main').attr("style", "margin-top: 0!important");
            });
            showPopup('ohterwebsite');
        }

        crnt.parents('.sc-ui-design:first').fadeOut(function () {
            crnt.parents('.sc-ui-design:first').next('.sc-ui-design').fadeIn();
        });
    } else if (crnt.attr("data-btnaction") === "choose_sub_tunnel") {
        nextcardinprevtunnel = crnt.parents(".sc-ui-design:first");
        crnt.parents(".sc-ui-design:first").fadeOut(function () {
            $("#" + crnt.attr("data-subtunnel") + " .sc-ui-design").css("display", "none");
            if (crnt.attr("data-subtunnelcard") === "") {
                $("#" + crnt.attr("data-subtunnel") + " .sc-ui-design:first-child").css("display", "block");
            } else {
                $("#" + crnt.attr("data-subtunnel") + " .sc-ui-design.subtunnelcard_" + crnt.attr("data-subtunnelcard")).css("display", "block");
            }
            $("#" + crnt.attr("data-subtunnel")).fadeIn();
        });
    } else if (crnt.attr("data-btnaction") === "next_card_in_last_prior_tunnel") {
        crnt.parents('.sc-ui-design:first').fadeOut(function () {
            nextcardinprevtunnel.fadeIn();
        });
    } else if (crnt.attr("data-btnaction") === "set_reminder") {
        if ($("body").hasClass("logged-in")) {
            showPopup('reminder');
        } else {
            alert("You need to login first");
            showPopup('login');
        }
    } else {
        crnt.parents('.sc-ui-design:first').fadeOut(function () {
            crnt.parents('.sc-ui-design:first').next('.sc-ui-design').fadeIn();
        });
    }


    // wait for new card to load
    window.setTimeout(function () {
        // saving current card so if user reloads, we can show him same card
        let categoryName = $('#za_category_page').attr('data-categorySlug')
        let row = window.localStorage.getItem('category_current_card')
        let category_current_card = row ? JSON.parse(row) : {}
        var dataItem;
        $(".sc-ui-design").filter(function () {
            let crnt_card = $(this);
            if (!crnt_card.hasClass("subtunnel")) {
                return $(this).css("display") === "block";
            }
        }).each(function () {
            category_current_card[categoryName] = $(this).attr("data-cardidentifier");
            window.localStorage.setItem('category_current_card', JSON.stringify(category_current_card))
        });
    }, 1500)


});



if (document.querySelector(".category")) {
    let categoryName = $('#za_category_page').attr('data-categorySlug')
    let row = window.localStorage.getItem('category_current_card')
    let category_current_card = row ? JSON.parse(row) : {};
    let crnt_saved_card = category_current_card[categoryName];
    if (crnt_saved_card !== undefined) {
        $(".sc-ui-design").css("display", "none");
        $(".sc-ui-design[data-cardidentifier='" + crnt_saved_card + "']").parents(".subtunnel").css("display", "block");
        $(".sc-ui-design[data-cardidentifier='" + crnt_saved_card + "']").css("display", "block");
    }
}



$(document).on('click', '.js-remove-iframesrc', function (e) {

    let crnt = $(this);

    crnt.parents(".popup__body").find("iframe").attr("src", "");

});


$(document).on('click', '.js-back-tunnel-card', function (e) {
    e.preventDefault()
    let crnt = $(this);

    crnt.parents('.sc-ui-design:first').fadeOut(function () {
        crnt.parents('.sc-ui-design:first').prev('.sc-ui-design').fadeIn();
    });

});

$(document).on('click', '.js-show-reminderpage-btn', function (e) {
    e.preventDefault()
    let crnt = $(this);
    if ($("body").hasClass("logged-in")) {
        window.location.href = crnt.attr("href");
    } else {
        alert("You need to login first");
        showPopup('login');
    }

})


$(document).on("click", "#za-payment-button", function (e) {
    e.preventDefault();
    var stepFormData = convertFormToJSON('#zaPaymentForm');

    jQuery.ajax({
        type: "post",
        dataType: "json",
        url: rlghData.ajaxurl,
        data: { action: "zaCreateSessionStripe", data: stepFormData },
        beforeSend: function () {
            $('#loader').show();
        },
        success: function (response) {
            if (response.success == true) {
                $('#loader').hide();
                window.open(response.message, '_blank');
                // $(".js-paymentScreenForUserToPay").attr("src", response.message);
            } else {
                alert(response.message);
            }
        },
        error: function () {
            $('#loader').hide();
        }
    });
});

/*
 * ----------------Category Page New Design ends here---------------------
 * ----------------Category Page New Design ends here---------------------
 * ----------------Category Page New Design ends here---------------------
 */