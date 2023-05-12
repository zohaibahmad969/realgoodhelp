"use strict";

const ROOTS = getComputedStyle(document.documentElement);
const HOVERTIME = getNumber(ROOTS.getPropertyValue('--hover-time'));
const CURRENCY = rlghData.currency;

let isAnimated = false;





/*
 * ---------------------------Self Help Landing page v2--------------------------------
 */
if (document.querySelector('.realgh-self-help-lp-bg-page')) {

    document.querySelector('.header').classList.add('header-transparent');
    document.querySelector('.header__logo img').setAttribute('src', 'http://www.realgoodhelp.com/wp-content/uploads/2023/03/main-logo-transparent.png')
        // Add event listener to the window object
    window.addEventListener('scroll', function() {
        if (window.scrollY >= 100) {
            document.querySelector('.header').classList.add('header-white');
            document.querySelector('.header').classList.remove('header-transparent');
            document.querySelector('.header__logo img').setAttribute('src', 'http://www.realgoodhelp.com/wp-content/uploads/2023/01/logo.svg')
        } else {
            document.querySelector('.header').classList.remove('header-white');
            document.querySelector('.header').classList.add('header-transparent');
            document.querySelector('.header__logo img').setAttribute('src', 'http://www.realgoodhelp.com/wp-content/uploads/2023/03/main-logo-transparent.png')
        }
    });


    $(document).on('click', '.main-lp-theme-box', function() {
        let crnt = $(this);
        window.location.href = crnt.attr('data-cat-url');
    });
}




/*
 * ---------------------------service worker--------------------------------
 */
if (typeof navigator.serviceWorker !== 'undefined') {
    navigator.serviceWorker.register('/sw.js')
}


/*
 * ---------------------------popups--------------------------------
 */

if (document.querySelector('.popup')) popupInit();

function popupInit() {
    const btns = document.querySelectorAll('.js-popup');

    btns.forEach((btn) => btn.addEventListener('click', (e) => {
        e.preventDefault()
        showPopup(btn.dataset.popup)
    }))
}

function showPopup(popupClass) {
    if (isAnimated) return;
    isAnimated = true;
    setTimeout(() => (isAnimated = false), HOVERTIME)

    let existPopup = document.querySelector('.popup.show')
    const popup = document.querySelector(`.${popupClass}__popup`);
    const closeBtn = popup.querySelector('.js-close-popup')

    if (existPopup) {
        closePopup(existPopup)
        setTimeout(() => (popup.classList.add("show")), HOVERTIME)
    } else {
        popup.classList.add("show")
        if (popup.classList.contains('video-popup')) popupVideo(popup, 'play');
    }
    lockScroll();

    window.addEventListener("click", isClosePopup);
    if (closeBtn) closeBtn.addEventListener("click", isClosePopup);

    function isClosePopup(e) {
        if (isAnimated) return;
        isAnimated = true;
        setTimeout(() => (isAnimated = false), HOVERTIME);
        if (!e.target.closest(".popup__body") || e.target.closest('.js-close-popup')) closePopup(e.target.closest('.popup.show'));
    }

    function closePopup(curPopup) {
        if (curPopup.classList.contains("locked")) return;
        const curCloseBtn = curPopup.querySelector('.js-close-popup')

        window.removeEventListener("click", isClosePopup);
        if (curCloseBtn) curCloseBtn.removeEventListener("click", isClosePopup);
        if (popup.classList.contains('video-popup')) popupVideo(popup, 'pause');
        if (popup.classList.contains('ohterwebsite__popup')) popupVideo(popup, 'pause');

        unlockScroll();
        curPopup.classList.remove("show");
    }
}

//---------------------------video-popup (Added by Zohaib)--------------------------------
function popupVideo(popup, command) {
    const video = popup.querySelector('.video')

    video.contentWindow.postMessage(
        JSON.stringify({ event: 'command', func: `${command}Video` }), '*'
    )
}
//---------------------------lock scroll--------------------------------
function lockScroll() {
    const elems = document.querySelectorAll(".js-padding");

    elems.forEach((elem) => {
        const currentPadding = getNumber(
            window.getComputedStyle(elem, null).getPropertyValue("padding-right")
        );

        elem.style.paddingRight = getScrollWidth() + currentPadding + "px";
    });

    document.documentElement.style.overflow = "hidden";
}

function unlockScroll() {
    const elems = document.querySelectorAll(".js-padding");

    elems.forEach((elem) => {
        elem.style.paddingRight = "";
    });

    document.documentElement.style.overflow = "";
}

//---------------------------review popup--------------------------------
if (document.querySelector('.client-schedule__history')) reviewPopupInit();

function reviewPopupInit() {
    const popup = document.querySelector('.review__popup')
    const inputId = popup.querySelector('input[name="therapist_id"]')
    const form = popup.querySelector('.form')
    const historyBlock = document.querySelector('.client-schedule__history')
    const btns = historyBlock.querySelectorAll('.client-schedule__button')

    btns.forEach((btn) => btn.addEventListener('click', () => {
        inputId.value = btn.dataset.psycho
    }))
    form.addEventListener('submit', async(e) => {
        e.preventDefault()
        const response = await sendForm(form, 'review')

        if (!response) return;

        if (response.success) {
            removeReviewButtons(inputId.value)
            showPopup('review-suc')
            form.reset()
            resetRating(form)
        } else {
            alert("Some error - please try again")
        }
    })
}

function removeReviewButtons(id) {
    document.querySelectorAll(`.client-schedule__button[data-psycho="${id}"]`)
        .forEach((btn) => btn.closest('.client-schedule__buttons').remove());
}



/*
 * ---------------------Rating--------------------
 */
if (document.querySelector('.review__popup')) ratingInit();

function ratingInit() {
    const popup = document.querySelector('.review__popup')
    const stars = popup.querySelectorAll('.js-rating-star')

    stars.forEach((star) => {
        const container = star.closest('.rating')
        const score = container.nextElementSibling

        star.addEventListener('mouseenter', () => {
            if (score.classList.contains('set')) return;

            score.style.width = star.dataset.num * 100 / 5 + '%'
        })
        star.addEventListener('mouseleave', () => {
            if (score.classList.contains('set')) return;

            score.style.width = '0%'
        })
        star.addEventListener('click', () => {
            const cell = star.closest('.form__cell')
            const input = cell.querySelector('.input')

            score.style.width = star.dataset.num * 100 / 5 + '%'
            score.classList.add('set')
            input.value = star.dataset.num
            input.dispatchEvent(new Event('input'))
        })
    })
}

function resetRating(form) {
    const scores = form.querySelectorAll('.rating__score')

    scores.forEach((score) => {
        score.classList.remove('set')
        score.style.width = '0%'
    })
}


/*
 * ---------------------Sliders--------------------
 */
// auto-slider

const AUTO_TIME = 2000;
let slider_state = getDevice();

if (document.querySelector(".auto-slider")) {
    autoSliderInit();
}

function autoSliderInit() {
    const slider = document.querySelector(".auto-slider");
    const tape = slider.querySelector(".slider__tape");

    sliderFillPoints(slider);

    slider.count = 0;

    let autoSlide = setInterval(() => autoSliderSlide(slider), AUTO_TIME);

    const points = slider.querySelectorAll(".slider__point");
    points.forEach((point) =>
        point.addEventListener("click", () =>
            autoSliderSlide(slider, point.dataset.count)
        )
    );

    slider.addEventListener("mouseenter", () => {
        clearInterval(autoSlide);
    });
    slider.addEventListener("mouseleave", () => {
        autoSlide = setInterval(() => autoSliderSlide(slider), AUTO_TIME);
    });

    window.addEventListener("resize", () => slidesCount(slider));
}

function sliderFillPoints(slider) {
    const items = slider.querySelectorAll(".slider__item");
    const pointsBlock = slider.querySelector(".slider__points");
    const tapeCount = +ROOTS.getPropertyValue("--main-slider-count");

    pointsBlock.innerHTML = "";
    slider.pointsNum = Math.ceil(items.length / tapeCount);

    for (let i = 0; i < slider.pointsNum; i++) {
        createPoint(pointsBlock, i);
    }
}

function createPoint(block, i) {
    const node = document.createElement("div");
    node.className = "slider__point";
    node.dataset.count = i;

    if (i == 0) node.classList.add("active");

    block.append(node);
}

function updatePoints(slider) {
    const pointsBlock = slider.querySelector(".slider__points");
    const points = pointsBlock.querySelectorAll(".slider__point");

    pointsBlock.querySelector(".active").classList.remove("active");
    points[slider.count].classList.add("active");
}

function autoSliderSlide(slider, count = null) {
    const tape = slider.querySelector(".slider__tape");

    if (count == null) {
        slider.count = (slider.count + 1) % slider.pointsNum;
    } else {
        slider.count = count;
    }

    tape.style.transform = `translateX(${-slider.count * 100}%)`;
    updatePoints(slider);
}

function slidesCount(slider) {
    if (getDevice() == slider_state) return;

    slider_state = getDevice();
    sliderFillPoints(slider);
}



/*
 * ---------------------------Tabs--------------------------------
 */

if (document.querySelector(".tabs-container")) {
    tabsInit();
}

function tabsInit() {
    const tabsBlocks = document.querySelectorAll(".tabs");

    tabsBlocks.forEach((tabsBlock) => {
        const tabs = tabsBlock.querySelectorAll(".tab");

        tabs.forEach((tab) => tab.addEventListener("input", () => changeTab(tab)));
    });
}

function changeTab(tab) {
    const tabsContainer = tab.closest(".tabs-container")
    const tabContent = tabsContainer.querySelector(".tabs__content")

    const current = tabContent.querySelector(".active")
    const target = tab.dataset.tabItem

    if (current) current.classList.remove("active");

    tabContent.querySelector(`#${target}`).classList.add("active")
}



/*
 * ---------------------------Input range--------------------------------
 */

if (document.querySelector('.input-range')) {
    rangeInit()
}

function rangeInit() {
    const ranges = document.querySelectorAll('.input-range')

    ranges.forEach((range) => {
        const valueCont = range.nextElementSibling.querySelector('.output__content')
        valueCont.textContent = range.value

        range.addEventListener('input', () => valueCont.textContent = range.value)
    })
}



/*
 * ---------------------------JS link--------------------------------
 */
if (document.querySelector('.js-link')) jsLinkInit();

function jsLinkInit() {
    const links = document.querySelectorAll('.js-link')

    links.forEach((link) => link.addEventListener('click', (e) => {
        e.preventDefault()
        window.location.href = link.dataset.href
    }))
}



/*
 * ---------------------Conditional input--------------------
 */
if (document.querySelector('.check-condition')) conditionalInit();

function conditionalInit() {
    const checks = document.querySelectorAll('.check-condition')

    checks.forEach((check) => {
        const container = check.closest('.form__cell')
        const input = container.querySelector('.input')

        input.disabled = !check.checked

        check.addEventListener('change', () => input.disabled = !check.checked)
    })
}



/*
 * ---------------------Timetable--------------------
 */

if (document.querySelector('.timetable')) timetableInit();

function timetableInit() {
    const timetable = document.querySelector('.timetable')
    const weekdays = timetable.querySelectorAll('.timetable__row')

    weekdays.forEach((weekday) => {
        const check = weekday.querySelector('.check__input')
        const addBtn = weekday.querySelector('.timetable__add-button')

        check.addEventListener('change', () => {
            if (check.checked == true) {
                addIntervalRow(weekday)
            } else {
                const intervals = weekday.querySelectorAll('.workhours__row')
                intervals.forEach((timeRow) => removeIntervalRow(timeRow))
            }
        })
        addBtn.addEventListener('click', () => addIntervalRow(weekday))
        weekday.addEventListener('click', (e) => {
            if (!e.target.closest('.workhours__remove-button')) return;

            const timeRow = e.target.closest('.workhours__row')
            removeIntervalRow(timeRow)
        })
    })
}

function addIntervalRow(weekday) {
    const timetable = weekday.closest('.timetable')
    const temp = timetable.querySelector('#workhours-temp').content
    const container = weekday.querySelector('.timetable__intervals')
    const input = weekday.querySelector('.check__input')

    const node = temp.cloneNode(true)
    const stInput = node.querySelector('.workhours__start')
    const endInput = node.querySelector('.workhours__end')

    stInput.name = 'availability_hours[' + input.value + '_int][]'
    endInput.name = 'availability_hours[' + input.value + '_int][]'

    if (isWeekdayEmpty(weekday)) {
        container.innerHTML = ''
        input.checked = true
    } else {
        const intervals = weekday.querySelectorAll('.workhours__row')
        const [hours, mins] = parseTime(
            intervals[intervals.length - 1].querySelector('.workhours__end').value
        )

        stInput.value = `${leadingZero(hours)}:${leadingZero(mins)}`
        endInput.value = `${leadingZero((hours + 1) % 24)}:${leadingZero(mins)}`
    }

    container.append(node)
}

function removeIntervalRow(row) {
    const weekday = row.closest('.timetable__row')
    const timetable = weekday.closest('.timetable')
    const container = weekday.querySelector('.timetable__intervals')

    row.remove()

    if (isWeekdayEmpty(weekday)) {
        const input = weekday.querySelector('.check__input')
        const node = document.createElement('p')
        node.className = 'text note'
        node.textContent = timetable.dataset.empty

        container.append(node)
        input.checked = false
    }
}

function isWeekdayEmpty(weekday) {
    return !weekday.querySelectorAll('.workhours__row').length
}



/*
 * ---------------------Calendar--------------------
 */
const HOUR_HEIGHT = getNumber(ROOTS.getPropertyValue("--calendar-cell-height"))
const PART_HEIGHT = HOUR_HEIGHT / 6
const PART_VALUE = 10
const YEARS = 2
const WEEKDAYS = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']

if (document.querySelector('.calendar')) {
    calendarInit()

    window.addEventListener('resize', () => setSessionWidth())
}

async function calendarInit() {
    const calendar = document.querySelector('.calendar')
    const container = calendar.closest('.tab__item')
    const month = calendar.querySelector('.calendar__month')
    const year = calendar.querySelector('.calendar__year')

    const calendarReq = new FormData()
    calendarReq.append('id', calendar.dataset.psycho)
    calendarReq.append('action', 'calendar_data')

    const calendarData = await fetch(rlghData.ajaxurl, {
            method: "POST",
            body: calendarReq,
        })
        .then(response => response.json())
        .then(response => { return response.data })

    for (let i = 0; i < YEARS; i++) {
        const option = document.createElement('option')
        option.setAttribute('value', new Date().getFullYear() + i)
        option.appendChild(document.createTextNode(new Date().getFullYear() + i))
        year.append(option)
    }

    calendarData.intervals = JSON.parse(calendarData.intervals)
    calendar.reservation = calendarData.reservation
    calendar.break = calendarData.break
    if (document.querySelector('#timezone')) {
        const select = document.querySelector('#timezone')
        calendar.timezone = +select.value

        select.addEventListener('change', () => {
            calendar.timezone = +select.value

            const firstWeekday = calendar.querySelector('.calendar__day-block')
            let fullDate = new Date(firstWeekday.date)

            workHours = setCalendarTime(calendar, calendarData)
            setCalendarDate(calendar, fullDate)
            calendarSetup(calendar, calendarData, workHours)
        })
    } else {
        calendar.timezone = +calendarData.timezone
    }

    let workHours = setCalendarTime(calendar, calendarData)
    createCalendarCells(calendar)

    const nowDate = new Date()
    const timezoneOffset = nowDate.getTimezoneOffset() + calendar.timezone
    nowDate.setMinutes(nowDate.getMinutes() + timezoneOffset)
    setCalendarDate(calendar, nowDate)

    calendarSetup(calendar, calendarData, workHours)

    // events
    if (document.querySelector('#step-1')) {
        bookingCalendarEvents(calendar)
    } else if (calendar.classList.contains('psycho')) {
        psychoCalendarEvents(calendar)
    }

    generalCalendarEvents(calendar)
}

function setCalendarTime(calendar, calendarData) {
    const timeBlock = calendar.querySelector('.calendar__time-block')

    let mins = null
    let workHours = new Set()

    for (let [weekday, dayHours] of Object.entries(calendarData.intervals)) {
        for (let interval in dayHours) {
            const stTime = new Date()
            const endTime = new Date()

            const [stHours, stMins] = parseTime(dayHours[interval][0])
            const [endHours, endMins] = parseTime(dayHours[interval][1])
            stTime.setHours(stHours, stMins + calendar.timezone, 0, 0)
            endTime.setHours(endHours, endMins + calendar.timezone, 0, 0)
            if (!mins) mins = stTime.getMinutes();

            const curTime = new Date(stTime)
            if (stTime > endTime) endTime.setDate(endTime.getDate() + 1);

            while (curTime.getTime() < endTime.getTime()) {
                workHours.add(curTime.getHours())
                curTime.setHours(curTime.getHours() + 1)
            }
            // if (stTime.getHours() > endTime.getHours()) {
            // 	for (let i = 0; i < endTime.getHours(); i++) { workHours.add(i) }
            // 	for (let i = stTime.getHours(); i < 24; i++) { workHours.add(i) }
            // } else {
            // 	for (let i = stTime.getHours(); i < endTime.getHours(); i++) { workHours.add(i) }
            // }
        }
    }

    workHours = Array.from(workHours).sort((a, b) => {
        return a - b
    })

    timeBlock.innerHTML = ''

    workHours.forEach((time) => {
        const timeNode = document.createElement('p')
        timeNode.className = 'text fz-16 calendar__cell calendar__time'
        timeNode.dataset.time = `${leadingZero(time)}:${leadingZero(mins)}`
        timeNode.innerHTML = formatTime(time, mins, '<br>')
        timeBlock.append(timeNode)
    })

    return workHours
}

function createCalendarCells(calendar) {
    const timeBlock = calendar.querySelector('.calendar__time-block')
    const dayBlocks = calendar.querySelectorAll('.calendar__day-block')

    dayBlocks.forEach((dayBlock) => {
        for (let i = 0; i < timeBlock.childElementCount; i++) {
            const dayNode = document.createElement('div')
            dayNode.className = 'calendar__cell'

            dayBlock.append(dayNode)
        }
    })
}

function calendarSetup(calendar, calendarData, workHours) {
    const body = calendar.querySelector('.calendar__body')
    const dayBlocks = body.querySelectorAll('.calendar__day-block')

    let i = 0
    const monday = dayBlocks[0].date


    dayBlocks.forEach((dayBlock) => {
        const dayCells = dayBlock.querySelectorAll('.calendar__cell')
        dayCells.forEach((cell) => cell.classList.add('disabled'))
    })

    for (let weekday of WEEKDAYS) {
        const workDay = calendarData.intervals[`${weekday}_int`]

        if (!workDay) {
            i++
            continue
        }

        for (let interval in workDay) {
            const stTime = new Date(monday)
            const endTime = new Date(monday)
            stTime.setDate(stTime.getDate() + i)
            endTime.setDate(endTime.getDate() + i)

            const [stHours, stMins] = parseTime(workDay[interval][0])
            const [endHours, endMins] = parseTime(workDay[interval][1])
            stTime.setHours(stHours, stMins + calendar.timezone, 0, 0)
            endTime.setHours(endHours, endMins + calendar.timezone, 0, 0)

            const curTime = new Date(stTime)
            if (stTime > endTime) endTime.setDate(endTime.getDate() + 1);

            while (curTime.getTime() < endTime.getTime()) {
                const weekday = (curTime.getDay() + 6) % 7
                const dayCells = dayBlocks[weekday].querySelectorAll('.calendar__cell')

                const availCell = workHours.indexOf(curTime.getHours())
                dayCells[availCell].classList.remove('disabled')

                curTime.setHours(curTime.getHours() + 1)
            }
        }

        i++
    }
}

function setCalendarDate(calendar, fullDate) {
    const body = calendar.querySelector('.calendar__body')
    const month = calendar.querySelector('.calendar__month')
    const year = calendar.querySelector('.calendar__year')
    const timeBlock = body.querySelector('.calendar__time-block')
    const timeCells = timeBlock.querySelectorAll('.calendar__time')
    const dayBlocks = body.querySelectorAll('.calendar__day-block')
    const calendarHeader = calendar.querySelector('.calendar__header')
    const dayHeaders = calendarHeader.querySelectorAll('.calendar__day-header')
    const prevBtn = calendar.querySelector('.prev-button')

    month.value = fullDate.getMonth()
    year.value = fullDate.getFullYear()

    const weekday = (fullDate.getDay() + 6) % 7
    fullDate.setDate(fullDate.getDate() - weekday)

    const nowDate = new Date()
    const timezoneOffset = nowDate.getTimezoneOffset() + calendar.timezone
    nowDate.setMinutes(nowDate.getMinutes() + timezoneOffset)
    nowDate.setHours(nowDate.getHours() + 1 + calendar.reservation)
    let i = 0

    dayBlocks.forEach((dayBlock) => {
        const dayText = dayHeaders[i].querySelector('.calendar__date')
        const dayCells = dayBlock.querySelectorAll('.calendar__cell')

        let j = 0
        const weekDate = new Date(fullDate)
        weekDate.setDate(weekDate.getDate() + i)

        timeCells.forEach((hourCell) => {
            const [hour, min] = parseTime(hourCell.dataset.time)

            weekDate.setHours(hour, min, 0, 0)

            if (nowDate > weekDate) {
                dayCells[j].classList.add('past')
            } else {
                dayCells[j].classList.remove('past')
            }

            j++
        })

        dayBlock.dataset.date = weekDate.getDate()
        dayBlock.date = weekDate

        dayText.innerHTML = weekDate.getDate()

        i++
    })

    if (body.querySelector('.past')) { prevBtn.disabled = true } else { prevBtn.disabled = false }

    fillWeekSessions(calendar, fullDate)
}

async function fillWeekSessions(calendar, fullDate) {
    const body = calendar.querySelector('.calendar__body')

    if (calendar.querySelector('.calendar__event.current')) removeSessionCard(calendar);
    const pastSes = body.querySelectorAll('.calendar__event')
    pastSes.forEach((ses) => ses.remove())

    const state = calendar.classList.contains('psycho') ? 'psycho' : 'client'

    const sessionReq = new FormData()
    sessionReq.append('id', calendar.dataset.psycho)
    sessionReq.append('day', fullDate.getDate())
    sessionReq.append('month', fullDate.getMonth() + 1)
    sessionReq.append('year', fullDate.getFullYear())
    sessionReq.append('for', state)
    sessionReq.append('action', 'session_data')

    const sessionsData = await fetch(rlghData.ajaxurl, {
            method: "POST",
            body: sessionReq,
        })
        .then(response => response.json())
        .then(response => { return response.data })

    for (let session of sessionsData) {
        const date = new Date(session.date)
        const [stHours, stMin] = parseTime(session.start)
        date.setHours(stHours, stMin + calendar.timezone, 0, 0)

        session.fullDate = new Date(date)
        createSessionCard(body, session, state)
    }

    setSessionWidth()
}

function createSessionCard(body, data, state) {
    const calendar = body.closest('.calendar')
    const dayBlock = body.querySelector(
        `.calendar__day-block[data-date="${data.fullDate.getDate()}"]`
    )
    if (!dayBlock && state == 'psycho') return;

    const temp = body.querySelector('#session-temp').content
    const card = temp.cloneNode(true).querySelector('.calendar__event')

    const endTime = new Date(data.fullDate)
    endTime.setMinutes(endTime.getMinutes() + data.duration)

    if (state == 'psycho') {
        const img = card.querySelector('.calendar__event-img')
        const name = card.querySelector('.calendar__event-name')

        card.href = data.url
        card.name = data.name
        card.date = `${leadingZero(data.fullDate.getDate())}-${leadingZero(data.fullDate.getMonth() + 1)}-${data.fullDate.getFullYear()}`
        card.method = uppFirstLetter(data.method)
        card.time = `${formatTime(data.fullDate.getHours(), data.fullDate.getMinutes())} - ${formatTime(endTime.getHours(), endTime.getMinutes())}`
        img.src = data.img
        name.textContent = data.name
    } else {
        const sessionContent = card.querySelector('.calendar__event-time')
        sessionContent.textContent =
            formatTime(data.fullDate.getHours(), data.fullDate.getMinutes()) +
            ' - ' +
            formatTime(endTime.getHours(), endTime.getMinutes());
    }
    if (state == 'client') card.classList.add('not-allow');
    if (state == 'current') card.classList.add('current');
    if (state != 'current') data.duration += calendar.break;
    card.stTime = data.fullDate
    card.duration = data.duration

    if (!dayBlock) {
        card.style.display = 'none'
        body.append(card)
        return
    }

    const parts = data.duration / PART_VALUE
    card.style.height = `${parts * PART_HEIGHT}px`

    const position = getSessionPosFromTime(body, data.fullDate.getHours(), data.fullDate.getMinutes())

    if (position === false) return;
    card.style.top = position + 'px'

    dayBlock.prepend(card)
}

function removeSessionCard(table) {
    table.querySelector('.calendar__event.current').remove()

    const curForm = table.closest('.form')
    const sesFieldsBlock = curForm.querySelector('.booking__calendar-fields')
    const sesFields = sesFieldsBlock.querySelectorAll('input')

    sesFields.forEach((input) => input.value = '')
}

function generalCalendarEvents(calendar) {
    const prevBtn = calendar.querySelector('.prev-button')
    const nextBtn = calendar.querySelector('.next-button')
    const month = calendar.querySelector('.calendar__month')
    const year = calendar.querySelector('.calendar__year')

    const firstWeekday = calendar.querySelector('.calendar__day-block')
    let fullDate = new Date(firstWeekday.date)

    prevBtn.addEventListener('click', () => {

        fullDate.setDate(fullDate.getDate() - 7)

        setCalendarDate(calendar, fullDate)
    })
    nextBtn.addEventListener('click', () => {
        fullDate.setDate(fullDate.getDate() + 7)

        setCalendarDate(calendar, fullDate)
    })
    month.addEventListener('change', () => {
        fullDate.setMonth(month.value)
        fullDate.setDate(1)

        setCalendarDate(calendar, fullDate)
    })
    year.addEventListener('change', () => {
        fullDate.setFullYear(year.value)
        fullDate.setMonth(month.value)
        fullDate.setDate(1)

        setCalendarDate(calendar, fullDate)
    })
}

function bookingCalendarEvents(calendar) {
    const prevStep = document.querySelector('#step-1')
    const prevInputs = prevStep.querySelectorAll('.time_duration')
    const body = calendar.querySelector('.calendar__body')
    const table = calendar.querySelector('.calendar__table')
    const hint = calendar.querySelector('.calendar__hint')

    const current = {}

    prevInputs.forEach((input) => input.addEventListener('input', () => {
        current.duration = +input.dataset.duration

        if (table.querySelector('.calendar__event.current')) removeSessionCard(table);
    }))

    table.addEventListener('mousemove', (e) => {
        if (
            e.target.closest('.disabled, .calendar__event, .past')
        ) {
            hint.classList.remove('show')
            return
        }
        if (!current.duration) {
            current.duration = +prevStep.querySelector('input:checked').dataset.duration;
        }

        requestAnimationFrame(() => {
            hint.classList.add('show')
            moveHint(e, current)
        })
    })
    table.addEventListener(
        'mouseleave',
        () => requestAnimationFrame(() => hint.classList.remove('show'))
    )

    table.addEventListener('click', (e) => {

        if (
            e.target.closest('.disabled, .calendar__event, .past') ||
            !isTimeAvailable(e, current.duration, calendar.break)
        ) {
            return
        }

        const prev = calendar.querySelector('.calendar__event.current')
        if (prev) prev.remove();

        const sessionDay = e.target.closest('.calendar__column')
        const date = new Date(sessionDay.date)
        const [stHour, stMin] = getSessionTimeFromPos(body, e.clientY)
        date.setHours(stHour, stMin, 0, 0)
        current.fullDate = new Date(date)

        createSessionCard(body, current, 'current')
        setSessionWidth()

        const fileds = document.querySelector('.booking__calendar-fields')
        date.setMinutes(date.getMinutes() - calendar.timezone)

        fileds.querySelector('input[name="session_date"]')
            .value =
            `${date.getFullYear()}-${leadingZero(date.getMonth() + 1)}-${leadingZero(date.getDate())}`;

        fileds.querySelector('input[name="session_start"]')
            .value = leadingZero(date.getHours()) + ':' + leadingZero(date.getMinutes());

        date.setMinutes(date.getMinutes() + current.duration)
        fileds.querySelector('input[name="session_end"]')
            .value = leadingZero(date.getHours()) + ':' + leadingZero(date.getMinutes());

        fileds.querySelector('input[name="session_duration"]')
            .value = current.duration;
    })
}

function psychoCalendarEvents(calendar) {
    const body = calendar.querySelector('.calendar__body')
    const hint = body.querySelector('.calendar__hint')
    const table = body.querySelector('.calendar__table')

    let intId
    table.addEventListener('mousemove', (e) => {
        if (e.target.closest('.calendar__event')) {
            psychoHint(body, e.target.closest('.calendar__event'))
        } else {
            hint.classList.remove('show')
        }
    })
}

function moveHint(e, data) {
    const body = e.target.closest('.calendar__body')
    const bodyPos = body.getBoundingClientRect()
    const calendar = body.closest('.calendar')
    const cell = e.target.closest('.calendar__cell')
    const hint = body.querySelector('.calendar__hint')
    const hintText = hint.querySelector('.calendar-hint__text')

    if (!isTimeAvailable(e, data.duration, calendar.break)) {
        cell.classList.add('not-allow')
        hint.classList.remove('show')
        return
    } else if (cell.classList.contains('not-allow')) {
        cell.classList.remove('not-allow')
    }

    const hintTop = e.clientY - bodyPos.top

    const [stHour, stMin] = getSessionTimeFromPos(body, e.clientY)
    const endTime = stHour * 60 + stMin + data.duration
    const endHour = Math.floor(endTime / 60) % 24
    const endMin = endTime % 60

    hintText.textContent = formatTime(stHour, stMin) + ' - ' + formatTime(endHour, endMin)

    hint.style.top = hintTop + 'px'
    hint.style.left = `${e.clientX - bodyPos.left - 5}px`
}

function psychoHint(body, card) {
    const hint = body.querySelector('.calendar__hint')
    const name = hint.querySelector('.calendar-hint__name')
    const texts = hint.querySelectorAll('.calendar-hint__text')

    name.textContent = card.name
    texts[0].textContent = card.date
    texts[1].textContent = card.time
    texts[2].textContent = card.method

    const hintPos = hint.getBoundingClientRect()
    const bodyPos = body.getBoundingClientRect()
    const cardPos = card.getBoundingClientRect()

    const cardTop = cardPos.top - bodyPos.top
    const cardLeft = cardPos.left - bodyPos.left

    hint.classList.remove('bottom', 'top', 'right')
    if (bodyPos.bottom - cardPos.bottom < hintPos.height + 10) {
        hint.style.top = cardTop - hintPos.height - 12 + 'px'
        hint.style.left = cardLeft + 'px'

        hint.classList.add('top')
    } else {
        hint.style.top = cardTop + cardPos.height + 12 + 'px'
        hint.style.left = cardLeft + 'px'

        hint.classList.add('bottom')
    }
    if (cardLeft < hintPos.width + 10) {
        hint.style.left = cardLeft + cardPos.width + 'px'
        hint.classList.add('right')
    }

    hint.classList.add('show')
}

function setSessionWidth() {
    const calendar = document.querySelector('.calendar')
    const column = calendar.querySelector('.calendar__day-block')
    const sessions = calendar.querySelectorAll('.calendar__event')

    sessions.forEach((session) => {
        session.style.width = column.clientWidth + 'px'
    })
}

function getSessionTimeFromPos(body, yPos) {
    const bodyPos = body.getBoundingClientRect()
    const hourBlocks = body.querySelectorAll('.calendar__time')

    const posTop = yPos - bodyPos.top

    let stHour = null
    let stMin
    const stTime = new Date()
    hourBlocks.forEach((hour) => {
        if (stHour != null) return;

        const hourPos = hour.getBoundingClientRect().top - bodyPos.top

        if (Math.floor(posTop - hourPos) <= HOUR_HEIGHT) {
            [stHour, stMin] = parseTime(hour.dataset.time)
            stTime.setHours(
                stHour,
                stMin + Math.floor(Math.abs(posTop - hourPos) / PART_HEIGHT) * PART_VALUE,
                0,
                0
            )
        }
    })

    return [stTime.getHours(), stTime.getMinutes()]
}

function getSessionPosFromTime(body, hours, mins) {
    const startMins = +body.querySelector('.calendar__time').dataset.time.split(':')[1]

    if (mins < startMins) {
        const newHours = (hours + 23) % 24
        return getSessionPosFromTime(body, newHours, mins + 60)
    }

    const startHour = body.querySelector(`.calendar__time[data-time^="${leadingZero(hours)}"]`)
    if (!startHour) return false;

    let position = startHour.getBoundingClientRect().top - body.getBoundingClientRect().top

    position += ((mins - startMins) / PART_VALUE) * PART_HEIGHT

    return position
}

function isTimeAvailable(e, dur, sesBreak) {
    const column = e.target.closest('.calendar__column')
    const body = column.closest('.calendar__body')
    const sessions = body.querySelectorAll('.calendar__event.not-allow')

    const [sesHour, sesMin] = getSessionTimeFromPos(body, e.clientY)
    const stTime = new Date(column.date)
    stTime.setHours(sesHour, sesMin, 0, 0)

    const endTime = new Date(stTime)
    endTime.setMinutes(endTime.getMinutes() + dur + sesBreak)

    // overlap with other sessions
    let isOverlap = false
    sessions.forEach((session) => {
        if (isOverlap) return;

        const endSesTime = new Date(session.stTime)
        endSesTime.setMinutes(endSesTime.getMinutes() + session.duration)

        if (stTime > endSesTime || endTime < session.stTime) return;
        if (
            (stTime < session.stTime && endTime > session.stTime) ||
            (stTime < endSesTime && endTime > endSesTime)
        ) isOverlap = true;
    })
    if (isOverlap) return false;

    // intersection of the break line
    const endPos = getSessionPosFromTime(body, endTime.getHours(), endTime.getMinutes())
    if (endPos === false && !isThresholdTime(body, endTime)) return false;

    const stPos = getSessionPosFromTime(body, stTime.getHours(), stTime.getMinutes())
    let sesHeight = endPos - stPos
    if (sesHeight < 0) sesHeight += body.getBoundingClientRect().bottom + pageYOffset;
    const expectedHeight = ((dur + sesBreak) / PART_VALUE) * PART_HEIGHT

    if (sesHeight < expectedHeight) return false;

    // overlapping of the blocked time
    let curCell = e.target.closest('.calendar__cell')
    const [curH, curM] = getSessionTimeFromPos(body, curCell.getBoundingClientRect().top)
    const curTime = new Date(stTime)
    curTime.setHours(curH, curM, 0, 0)

    while (curTime.getTime() < endTime) {
        if (curCell.classList.contains('disabled')) return false;

        curTime.setHours(curTime.getHours() + 1)
        if (!curCell.nextElementSibling) {
            if (!column.nextElementSibling) {
                if ((e.clientY + expectedHeight) > body.getBoundingClientRect().bottom) {
                    return false
                } else {
                    return true
                }
            }
            curCell = column.nextElementSibling.querySelector('.calendar__cell')
        } else {
            curCell = curCell.nextElementSibling
        }
    }

    return true;
}

function isThresholdTime(body, time) {
    const prevHourBlock = body.querySelector(
        `.calendar__time[data-time^="${leadingZero(time.getHours() - 1)}"]`
    )
    if (!prevHourBlock) return false;

    const [prevHour, prevMin] = parseTime(prevHourBlock.dataset.time)
    const thresholdTime = new Date(time)
    thresholdTime.setHours(prevHour + 1, prevMin, 0, 0)

    return time.getTime() <= thresholdTime.getTime()
}

/*
 * ---------------------Drop-down--------------------
 */
if (document.querySelector('.dropdown__container')) dropdownInit();

function dropdownInit() {
    const containers = document.querySelectorAll('.dropdown__container')

    containers.forEach((container) => {
        const dropdown = container.querySelector('.dropdown')
        container.addEventListener('mouseenter',
            () => dropdown.style.height = `${getRealHeight(dropdown)}px`
        )
        container.addEventListener('mouseleave',
            () => dropdown.style.height = '0'
        )
    })
}



/*
 * ---------------------Readmore--------------------
 */

if (document.querySelector('.readmore')) readmoreInit();

function readmoreInit() {
    const containers = document.querySelectorAll('.readmore__container')

    setReadmoreHeight(containers)

    containers.forEach((container) => {
        const readmore = container.querySelector('.readmore')
        const cover = container.querySelector('.readmore__cover')

        cover.addEventListener('click', () => readmoreAction(readmore))
    })

    window.addEventListener('resize', () => setReadmoreHeight(containers))
}

function readmoreAction(readmore) {
    readmore.classList.toggle('show')

    if (readmore.classList.contains('show')) {
        readmore.style.maxHeight = `${getRealHeight(readmore)}px`
    } else {
        readmore.style.maxHeight = `${getRealHeight(readmore, 1)}px`
    }
}

function setReadmoreHeight(containers) {
    containers.forEach((container) => {
        const readmore = container.querySelector('.readmore')

        if (readmore.classList.contains('show')) {
            readmore.style.maxHeight = `${getRealHeight(readmore)}px`
        } else {
            readmore.style.maxHeight = `${getRealHeight(readmore, 1)}px`
        }
    })
}



/*
 * ---------------------Steps--------------------
 */
if (document.querySelector(".steps")) { stepsInit() }

function stepsInit() {
    const container = document.querySelector(".steps")
    const questionnaire = container.querySelector('#questionariesForm')
    const btnNext = container.querySelectorAll('.steps__button.next')
    const btnBack = container.querySelectorAll('.steps__button.back')

    btnNext.forEach((btn) => btn.addEventListener('click', (e) => {
        e.preventDefault()
        const form = btn.closest('.tab__item')

        if (!formValidation(form)) return;
        if (questionnaire) sendQuestionnaire(form, +btn.dataset.step - 1)

        changeStep(btn.dataset.step)
    }))
    btnBack.forEach((btn) => btn.addEventListener('click', () => changeStep(btn.dataset.step)))
}

function changeStep(stepNum) {
    const nav = document.querySelector('.steps-nav__content')
    const container = document.querySelector('.steps')

    nav.querySelector('.steps__nav-item.active').classList.remove('active')
    nav.querySelector(`#step-${stepNum}-tab`).classList.add('active')

    container.querySelector('.tab__item.active').classList.remove('active')
    container.querySelector(`#step-${stepNum}`).classList.add('active')

    window.scrollTo(0, 0)
}

if (document.querySelector('#questionariesForm')) {
    document.querySelector('#submitFormTyrpiest').addEventListener('click', (e) => {
        e.preventDefault()
        const form = e.target.closest('.tab__item')
        if (!formValidation(form)) return;
        sendQuestionnaire(form, 5)
    })
}

async function sendQuestionnaire(form, step) {
    const formData = new FormData(form)

    if (form.querySelector('.input-file')) {
        const inputFile = form.querySelector('.input-file')
        formData.append(inputFile.name, inputFile.files)
    }

    if (step != 1) {
        const user_email = document.getElementById('email').value
        formData.append('email', user_email)
    }


    formData.append('step', step)
    formData.append('action', 'registerStepsWizardFrom')
    if (step == 5) {
        jQuery('#loader').show();
    }

    const response = await fetch(rlghData.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(r => {
            if (step == 5) {
                jQuery('#loader').hide();
            }
            if (r.error) {
                jQuery("html, body").animate({ scrollTop: 0 }, 500);
                jQuery(".errorMsg").addClass('alert-error');
                jQuery(".errorMsg").html(r.error);
            } else {
                jQuery(".errorMsg").removeClass('alert-error');
                jQuery(".errorMsg").empty();
                return r.success;
            }
        })

    if (step == 5 && response) {
        showPopup('suc-reg')
    }
}



/*
 * ---------------------Filtration--------------------
 */
if (document.querySelector('.filter')) filterInit();

function filterInit() {
    const filter = document.querySelector('.filter')
    const filterInputs = filter.querySelectorAll('input')
    const popup = document.querySelector('.filter-popup__body')
    const closeBtn = popup.querySelector('.js-close-popup')
    const popupInputs = popup.querySelectorAll('input')
    const popupSendBtn = popup.querySelector('.filter-popup__send-button')
    const popupClearBtn = popup.querySelector('.filter-popup__clear-button')

    filterInputs.forEach((input) => input.addEventListener('change', () => {
        filterOutTherapists(filter)
        setSameFilterValue(popup, input, 'pop-' + input.name)
    }))
    popupInputs.forEach((input) => input.addEventListener('change', () => {
        const fieldName = input.name.replace('pop-', '')
        setSameFilterValue(filter, input, fieldName)
    }))
    popupSendBtn.addEventListener('click', () => {
        filterOutTherapists(filter)
        closeBtn.click()
    })
    popupClearBtn.addEventListener('click', () => {
        filter.reset()
        popup.reset()

        filterOutTherapists(filter)
        closeBtn.click()
    })
}
async function filterOutTherapists(filter) {
    const container = document.querySelector('.psycho__cards')

    container.classList.add('loading')
    const therapistsData = await sendForm(filter, 'filtration')
    if (!therapistsData.success) {
        // alert(therapistsData.data['response'])
        return
    } else {
        filterTherapists(container, therapistsData.data)
    }
    container.classList.remove('loading')
}

function filterTherapists(container, data) {
    const showMoreBlock = document.querySelector('.show-more__block')
    const curCount = showMoreBlock.querySelector('.psycho__cur-count')
    const globCount = showMoreBlock.querySelector('.psycho__glob-count')

    container.innerHTML = ''

    if (data['response']) {
        curCount.textContent = 0
        globCount.textContent = 0

        const node = document.createElement('p')
        node.className = 'subtitle ta-c'
        node.innerHTML = data['response']
        container.append(node)

        return
    }

    const temp = document.querySelector('#psycho-card-temp').content

    curCount.textContent = data.length
    globCount.textContent = data.length

    data.forEach((psycho) => {
        const card = temp.cloneNode(true).querySelector('.psycho__card')

        card.href = card.href + psycho['user_id']
        card.querySelector('.psycho-card__img').src = psycho['user_profile_pic']
        card.querySelectorAll('.psycho-card__30-rate').forEach((text) => {
            if (!psycho['half_rate']) {
                text.closest('.info__section').style.display = 'none'
            } else {
                text.textContent = psycho['half_rate'] + ' ' + CURRENCY
            }
        })
        card.querySelectorAll('.psycho-card__60-rate').forEach((text) => {
            if (!psycho['hourly_rate']) {
                text.closest('.info__section').style.display = 'none'
            } else {
                text.textContent = psycho['hourly_rate'] + ' ' + CURRENCY
            }
        })
        card.querySelectorAll('.money-back-btn').forEach((btn) =>
            btn.style.display = !+psycho['money_back_guarantee'] ? 'none' : ''
        )
        if (card.querySelector('.js-link')) {
            card.querySelectorAll('.js-link').forEach((link) =>
                link.dataset.href = link.dataset.href + psycho['user_id']
            )
        }
        card.querySelector('.psycho-card__name').textContent =
            psycho['first_name'] + ' ' + psycho['last_name'];
        card.querySelector('.psycho-card__qual').textContent =
            psycho['qualification'];
        card.querySelector('.psycho-card__exp').textContent =
            psycho['experience'] + ' years';
        card.querySelector('.psycho-card__method').textContent =
            parseDBArrays(psycho['main_method'])[0];

        const specs = parseDBArrays(psycho['specialization'])
        const list = card.querySelector('.psycho-card__spec')
        specs.forEach((spec) => {
            const node = document.createElement('li')
            node.className = 'list__item text fz-14 fw-600 tt-ca'
            node.textContent = spec

            list.append(node)
        })

        card.querySelector('.psycho-card__intro-text').textContent =
            psycho['about_myself'];
        const tabs = card.querySelector('.tabs-container')
        const tab = tabs.querySelector('.tab')
        const label = tabs.querySelector('.label')
        const tabItem = tabs.querySelector('.tab__item')

        tab.dataset.tabItem = tab.dataset.tabItem + psycho['user_id']
        tab.name = tab.name + psycho['user_id']
        tab.id = tab.id + psycho['user_id']
        label.htmlFor = label.htmlFor + psycho['user_id']
        tabItem.id = tabItem.id + psycho['user_id']

        container.append(card)
    })

    psychoCardsConnectEvent(container)
}

function psychoCardsConnectEvent(container) {
    const popupBtns = container.querySelectorAll('.js-popup')
    const jsLinks = container.querySelectorAll('.js-link')

    popupBtns.forEach((btn) => btn.addEventListener('click', (e) => {
        e.preventDefault()
        showPopup(btn.dataset.popup)
    }))
    jsLinks.forEach((link) => link.addEventListener('click', (e) => {
        e.preventDefault()
        window.location.href = link.dataset.href
    }))
}

function parseDBArrays(str) {
    let i = 1
    const arr = str.split('"')
    const values = []

    while (arr[i]) {
        values.push(arr[i])
        i += 2
    }

    return values
}

function setSameFilterValue(form, curInput, name) {
    const inputs = form.querySelectorAll(`.input[name="${name}"]`)
    let checked = false

    inputs.forEach((input) => {
        if (checked) return;

        if (input.value === curInput.value) {
            input.checked = curInput.checked
            checked = true
        }
    })
}



/*
 * ---------------------Forms--------------------
 */
if (document.querySelector('.edit-prof__form')) editProfileInit();

function editProfileInit() {
    const form = document.querySelector('.edit-prof__form')

    form.addEventListener('submit', (e) => {
        e.preventDefault()

        if (!formValidation(form)) {
            const errorInput = form.querySelector('.input.error, .input.empty')
            const errorTab = errorInput.closest('.tab__item')

            if (!errorTab || errorTab.classList.contains('active')) return;

            const targetTab = form.querySelector(`#${errorTab.id}-tab`)
            targetTab.click()
            return
        }
        $('#loader').show();

        form.submit()
    })
}

if (document.querySelector('.request__form')) clientRequestInit();

function clientRequestInit() {
    const form = document.querySelector('.request__form')
    const submit = form.querySelector('.js-send-button')

    submit.addEventListener('click', () => sendClientRequest(form))
}

async function sendClientRequest(form) {
    const response = await sendForm(form, 'request')

    if (!response) return;
    if (!response.success) {
        alert('Some error. Please try again')
        return
    } else {
        showPopup('suc-request')
    }
}



/*
 * ---------------------Send emails--------------------
 */

function showSuccessMessage(form) {
    const title = form.querySelector('.title')

    const node = document.createElement('p')
    node.className = 'text fw-600 success-message'
    node.textContent = 'Your request was submitted successfully'

    title.after(node)
}
// -------------support---------------
if (document.querySelector('.support__popup')) supportPopupInit();

function supportPopupInit() {
    const popup = document.querySelector('.support__popup')
    const form = popup.querySelector('.form')

    form.addEventListener('submit', (e) => sendSupportForm(e, form))
}
async function sendSupportForm(e, form) {
    e.preventDefault()

    if (!formValidation(form)) return;

    const fileInput = form.querySelector('.input-file')
    const formData = new FormData(form)
        // formData.append('file', fileInput.files)
    formData.append('action', 'support')

    const response = await fetch(rlghData.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(r => { return r.success })

    if (response) {
        const email = form.querySelector('.input[type="email"]').value
        sendMailToUser(email)

        showSuccessMessage(form)
        form.reset()
        fileInput.dispatchEvent(new Event('input'))
    } else {
        alert("Some error - please try again")
    }
}

function sendMailToUser(email) {
    const formData = new FormData()
    formData.append('email', email)
    formData.append('action', 'support_to_user')

    fetch(rlghData.ajaxurl, {
        method: 'POST',
        body: formData
    })
}

// -------------withdraw---------------
if (document.querySelector('.withdraw__popup')) withdrawPopupInit();

function withdrawPopupInit() {
    const popup = document.querySelector('.withdraw__popup')
    const form = popup.querySelector('.form')
    const input = form.querySelector('.input-text')
    const maxAmount = form.querySelector('.withdraw__max-amount')

    if (maxAmount) maxAmount.addEventListener('click', () => {
        input.value = parseFloat(maxAmount.textContent)
        input.dispatchEvent(new Event('input'))
    })
    form.addEventListener('submit', (e) => sendWithdrawForm(e, form))
}
async function sendWithdrawForm(e, form) {
    e.preventDefault()

    if (!formValidation(form)) return;

    const formData = new FormData(form)
    formData.append('action', 'withdraw')
    $('#loader').show()
    const response = await fetch(rlghData.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(r => {
            $('#loader').hide();
            showPopup('withdraw-thankyou');
            return r.success
        })

    if (response) {
        form.reset()
    } else {
        alert("Some error - please try again")
    }
}

// -------------reset-pass---------------
if (document.querySelector('.reset-request__popup')) resetPopupInit();

function resetPopupInit() {
    const popup = document.querySelector('.reset-request__popup')
    const form = popup.querySelector('.reset-request__form')

    form.addEventListener('submit', (e) => sendResetForm(e, form))
}
async function sendResetForm(e, form) {
    e.preventDefault()

    if (!formValidation(form)) return;

    const formData = new FormData(form)
    formData.append('action', 'reset-pass')

    const response = await fetch(rlghData.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(r => { return r.success })

    if (response) {
        const email = form.querySelector('input[type="email"]').value
        const popup = document.querySelector('.reset-answer__popup')
        const emailText = popup.querySelector('.reset-popup__email')
        emailText.textContent = email

        form.reset()
        showPopup('reset-answer')
    } else {
        alert("Some error - please try again")
    }
}


/*
 * ---------------------Book psychologist--------------------
 */
// ---------------------open popup--------------------
if (document.querySelector(".psycho-card__button")) {
    bookPopupInit();
}

function bookPopupInit() {
    const btns = document.querySelectorAll(".psycho-card__button");

    btns.forEach((btn) =>
        btn.addEventListener("click", () => openBookPopup(btn))
    );
}

function openBookPopup(btn) {
    const popup = document.querySelector(".book__popup");
    const input = popup.querySelector('input[name="id"]');

    input.setAttribute("value", btn.dataset.psycho);
    showPopup("book");
}

// ---------------------send form--------------------
if (document.querySelector(".book-popup__form")) {
    bookFormInit()
}

function bookFormInit() {
    const form = document.querySelector(".book-popup__form");
    const btn = form.querySelector(".book-popup__button");

    btn.addEventListener("click", (e) => sendLetter(e, form));
}

function sendLetter(e, form) {
    e.preventDefault();
    const inputs = form.querySelectorAll(".input");

    if (!formValidation(form)) return;

    const formData = new FormData();
    inputs.forEach((input) => {
        if (input.type == "radio") {
            if (!input.checked) return;
        }

        formData.append(input.name, input.value);
    });

    formData.append("action", "booking");

    fetch(rlghData.ajaxurl, {
            method: "POST",
            body: formData
        })
        .then(form.reset())
        .catch((error) => {
            error.json().then((response) => {
                alert(response.message);
            });
        });
}



/*
 * ---------------------Upload files--------------------
 */
const ICONS_PATH = rlghData.themePath + '/assets/img/icons/'

if (document.querySelector('.form__select-file')) { fileUploadInit() }

function fileUploadInit() {
    const fileBlocks = document.querySelectorAll('.form__select-file')

    fileBlocks.forEach((block) => {
        const input = block.querySelector('.input-file')

        input.addEventListener('input', () => uploadFiles(input))
    })
}

function uploadFiles(input) {
    const container = input.closest('.form__select-file')
    const inputPath = container.querySelector('.input-file--path')
    const filesBlock = container.querySelector('.form__file-content')
    const files = Array.from(input.files)
    const filesNameArr = []

    filesBlock.innerHTML = ''

    files.forEach((file) => {
        filesNameArr.push(file.name)
        const node = createFileCard(container, file)
        filesBlock.append(node)
    })

    inputPath.value = filesNameArr.join()
    inputPath.classList.add('filled')
    inputPath.dispatchEvent(new Event('input'))
}

function createFileCard(container, file) {
    const temp = container.querySelector('.temp__file-card').content
    const node = temp.cloneNode(true)
    const fileBlock = node.querySelector('.file-card__media-block')
    const name = node.querySelector('.file-card__name')
    const size = node.querySelector('.file-card__size')

    fileBlock.prepend(createCardsMedia(file))
    name.textContent = file.name
    size.textContent = getSizeFromBytes(file.size)
    node.querySelector('.file-card__button').addEventListener('click', removeFile)

    return node
}

function removeFile(e) {
    const btn = e.target.closest('.file-card__button')
    const card = btn.closest('.file__card, .single-file__card')
    const container = card.closest('.form__select-file')
    const inputPath = container.querySelector('.input-file--path')
    const name = card.querySelector('.file-card__name').textContent
    const input = container.querySelector('.input-file')
    let newFiles = new DataTransfer()
    const filesNameArr = []

    for (let file of input.files) {
        if (file.name != name) {
            newFiles.items.add(file)
            filesNameArr.push(file.name)
        }
    }

    btn.removeEventListener('click', removeFile)
    input.files = newFiles.files
    inputPath.value = filesNameArr.join()
    card.remove()

    if (!input.files.length) {
        inputPath.classList.remove('filled')
    }
}

function createCardsMedia(file) {
    const extension = getFileExtension(file.name)

    let node
    if (extension == 'mp4' || extension == 'x-m4v') {
        node = createVideoMedia()
    } else {
        node = createImageMedia()
    }

    node.src = ICONS_PATH
    switch (extension) {
        case 'pdf':
            node.src += 'pdf.svg'
            break
        case 'doc':
        case 'docx':
            node.src += 'doc.svg'
            break
        case 'jpeg':
        case 'jpg':
        case 'png':
        case 'mp4':
        case 'x-m4v':
            node.src = URL.createObjectURL(file)
            break
    }

    return node
}

function createVideoMedia() {
    const node = document.createElement('video')
    node.controls = true
    node.className = 'video'

    return node
}

function createImageMedia() {
    const node = document.createElement('img')
    node.className = 'img file-card__img'
    node.alt = 'File image'

    return node
}



/*
 * ---------------------Validation--------------------
 */
const PASS_LENGTH = 8

function formValidation(form) {
    const reqFields = form.querySelectorAll('.req-field')

    let isValid = true

    reqFields.forEach((field) => {
        // checkboxes and radio
        if (field.querySelector('.check__input')) {
            const inputs = field.querySelectorAll('.check__input')

            if (!isCheckFieldsChecked(inputs)) {
                isValid = false
                inputs.forEach((input) => {
                    input.classList.add('empty')

                    input.addEventListener('input', removeEmptyStateFromCheck)
                })
            }
            return
        }

        const input = field.querySelector('.input')

        // is empty
        if (!input.value) {
            input.classList.add('empty')
            isValid = false

            input.addEventListener('input', removeErrorState)
            return
        }

        // email
        if (input.type == 'email' && !validateEmail(input)) {
            isValid = false
        }

        // password
        if (input.type == 'password' && !validatePassword(input)) {
            isValid = false
        }
    })

    return isValid
}

function validateEmail(input) {
    const re = /\S+@\S+\.\S+/

    if (!re.test(input.value)) {
        const node = document.createElement('p')
        node.className = 'text fz-14 error-message'
        node.textContent = 'Please enter a valid email address'

        input.classList.add('error')
        input.parentNode.append(node)

        input.addEventListener('input', removeErrorState)

        return false
    }

    return true
}

function validatePassword(input) {
    if (input.value.length < PASS_LENGTH) {
        const node = document.createElement('p')
        node.className = 'text fz-14 error-message'
        node.textContent = `Please enter at least ${PASS_LENGTH} characters`

        input.classList.add('error')
        input.parentNode.append(node)

        input.addEventListener('input', removeErrorState)

        return false
    }

    return true
}

function removeEmptyStateFromCheck(e) {
    const checkBlock = e.target.closest('.req-field')
    const inputs = checkBlock.querySelectorAll('.check__input')

    inputs.forEach((input) => {
        input.classList.remove('empty')

        input.removeEventListener('change', removeEmptyStateFromCheck)
    })
}

function removeErrorState(e) {
    const input = e.target.closest('.input')

    if (input.classList.contains('error')) {
        input.parentNode.querySelector('.error-message').remove()
        input.classList.remove('error')
    } else {
        input.classList.remove('empty')
    }

    input.removeEventListener('input', removeErrorState)
}

function isCheckFieldsChecked(inputs) {
    let isChecked = false

    inputs.forEach((input) => {
        if (isChecked) return;

        isChecked = input.checked
    })

    return isChecked
}



/*
 * ---------------------Shiva--------------------
 */

// $("#submitFormTyrpiest").click(function (e) {
//   e.preventDefault();

//   if (formValidation(e.target.closest('.form'))) {
// 	 var userData = new FormData();
// 	 var formData = $("#questionariesForm").serialize();
// 	 userData.append("userdata", formData);
// 	 var profilePic = $("#prfilePic")[0].files[0];
// 	 var intro_video = $("#intro_video")[0].files[0];
// 	 userData.append("profile", profilePic);
// 	 jQuery.each($("#certificates")[0].files, function(i, file) {
// 		userData.append('certificates-'+i, file);
// 	 });
// 	 userData.append("intro_video", intro_video);
// 	 userData.append("action", "registerStepsWizardFrom");
// 	 $.ajax({gister_step
// 		method: "POST",
// 		url: rlghData.ajaxurl,
// 		data: userData,
// 		contentType: false,
// 		processData: false,
// 		dataType: "JSON",
// 		beforeSend: function(){
// 			$('#loader').show();
// 		},
// 	 }).done(function (msg) {
// 		var response = msg;
// 		$('#loader').hide();
// 		if (response.error) {
// 			$("html, body").animate({ scrollTop: 0 },500);
// 		  	jQuery(".errorMsg").addClass('alert-error');
// 		  	jQuery(".errorMsg").html(response.error);
// 		} else {
// 		  showPopup('suc-reg')
// 		}
// 	 });
//   }
// });

$("#loginForm").click(function(e) {
    e.preventDefault();

    var formValid = $("#ajaxLoginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: "required",
        },
    });
    formValid.form();
    formValid.valid();
    jQuery(".errorMsg").html("");
    jQuery(".successMsg").html("");

    if (formValid.valid()) {
        var formData = $("#ajaxLoginForm").serialize();
        $('#loader').show();
        $.ajax({
            method: "POST",
            url: rlghData.ajaxurl,
            data: { action: "manualUserLogin", data: formData },
            dataType: "JSON",
        }).done(function(msg) {
            var response = msg;
            if (response.loggedin !== true) {
                $('#loader').hide();
                jQuery(".errorMsg").addClass('alert-error');
                jQuery(".errorMsg").html(response.message);

            } else {
                //jQuery(".successMsg").html(response.message);
                setTimeout(function() {
                    // window.location.href = response.redirect_url;

                    // add user progress to localstorage
                    if (getSavedLocalStorageDataFromDB('saved_lessons') !== null) {
                        window.localStorage.setItem('saved_lessons', getSavedLocalStorageDataFromDB('saved_lessons'))
                    }
                    if (getSavedLocalStorageDataFromDB('lessons_answer') !== null) {
                        window.localStorage.setItem('lessons_answer', getSavedLocalStorageDataFromDB('lessons_answer'))
                    }
                    if (getSavedLocalStorageDataFromDB('themes_suggest') !== null) {
                        window.localStorage.setItem('themes_suggest', getSavedLocalStorageDataFromDB('themes_suggest'))
                    }
                    if (getSavedLocalStorageDataFromDB('themes_added') !== null) {
                        window.localStorage.setItem('themes_added', getSavedLocalStorageDataFromDB('themes_added'))
                    }
                    if (getSavedLocalStorageDataFromDB('show_cards_tutorial') !== null) {
                        window.localStorage.setItem('show_cards_tutorial', getSavedLocalStorageDataFromDB('show_cards_tutorial'))
                    }
                    if (getSavedLocalStorageDataFromDB('questionaire_results') !== null) {
                        window.localStorage.setItem('questionaire_results', getSavedLocalStorageDataFromDB('questionaire_results'))
                    }

                    // keep user in same page after login, just refresh
                    if($("body").hasClass("category")){
                        $("#loader").removeClass("is-active");
                        $(".login__popup").removeClass("show");
                        unlockScroll();
                        $("body").addClass("logged-in");
                        $(".cp-action-popup h2.title").text("You are successfully logged in.");
                        $('.cp-action-popup').css('display', 'block')
                        window.setTimeout(function() {
                            $('.cp-action-popup').css('display', 'none')
                        }, 4000)
                    }else{
                        window.location.href = window.location.href;
                    }
                }, 2000);
            }
        });
    }
});

if (document.querySelector('#prfilePic')) {
    const fileInput = document.querySelector('#prfilePic')
    const filePath = fileInput.nextElementSibling
    const container = fileInput.closest('.form__image-cell')
    const info = container.querySelector('.form-image__info')

    fileInput.addEventListener('input', () => {
        const file = fileInput.files[0]

        if (file && getSizeFromBytes(file.size, 'MB') < 5) {
            const reader = new FileReader()
            reader.addEventListener('load', () => {
                document.querySelector('#userUplodaedPic').setAttribute('src', reader.result)
                filePath.value = URL.createObjectURL(file)
                filePath.dispatchEvent(new Event('input'))
                info.classList.remove('error')
            })
            reader.readAsDataURL(file)
        } else {
            filePath.value = ''
            info.classList.add('error')
        }
    })
}


// counter lentgh 

$('.cus-counter').keyup(function() {
    var characterCount = $(this).val().length,
        current = $('#current'),
        maximum = $('#maximum'),
        theCount = $('#the-count');
    current.text(characterCount);
});
$('.cus-counter1').keyup(function() {
    var characterCount = $(this).val().length,
        current = $('#current1'),
        maximum = $('#maximum1'),
        theCount = $('#the-count');
    current.text(characterCount);
});

// Check box length limit

var bol = $("#form_special_wrap input:checkbox:checked").length >= 8;
$("#form_special_wrap input:checkbox").not(":checked").attr("disabled", bol);

$("#form_special_wrap input:checkbox").click(function() {
    var bol = $("#form_special_wrap input:checkbox:checked").length >= 8;
    $("#form_special_wrap input:checkbox").not(":checked").attr("disabled", bol);
});

// Date of birth limit

var today = new Date();
$('.datepicker_dob').datepicker({
    dateFormat: "yy-mm-dd",
    autoclose: true,
    orientation: "top",
    endDate: today,
    maxDate: 'today -1',
    changeMonth: true,
    changeYear: true,
    yearRange: "1940:2040"
});



/*
 * ---------------------Zohaib--------------------
 */

/*
 * ---------------------------save-lesson--------------------------------
 */
if (document.querySelector('.save-button')) {
    saveLessonInit()
}

function saveLessonInit() {
    const btn = document.querySelector('.save-button')

    isLessonSaved(btn)

    btn.addEventListener('click', () => saveLesson(btn))
}

function saveLesson(btn) {
    btn.classList.toggle('saved')

    if (btn.classList.contains('saved')) {
        const row = window.localStorage.getItem('saved_lessons')
        const lessonsId = row ? JSON.parse(row) : []

        lessonsId.push(btn.dataset.lesson)

        window.localStorage.setItem('saved_lessons', JSON.stringify(lessonsId))
    } else {
        const row = window.localStorage.getItem('saved_lessons')
        const lessonsId = JSON.parse(row)

        const idx = lessonsId.findIndex((themeId) => themeId == btn.dataset.lesson)
        lessonsId.splice(idx, 1)

        window.localStorage.setItem('saved_lessons', JSON.stringify(lessonsId))
    }

    // Save Data to database
    if ($("body").hasClass('logged-in')) {
        saveLocalStorageDataToDB('saved_lessons')
    }
}

function isLessonSaved(btn) {
    const row = window.localStorage.getItem('saved_lessons')
    const lessonsId = row ? JSON.parse(row) : []

    if (lessonsId.findIndex((themeId) => themeId == btn.dataset.lesson) != -1) {
        btn.classList.add('saved')
    }
}






/*
 * ---------------------------tunnel-form--------------------------------
 */
if (document.querySelector('.tunnel__form')) { tunnelFormInit() }

function tunnelFormInit() {
    const form = document.querySelector('.tunnel__form')
    const btn = form.querySelector('.tunnel__button')

    fillTunnelForm(form)

    btn.addEventListener('click', () => {
        saveLessonsAnswer(form)
        addSuggestions(form)
    })
    isFormCompleted(form)
}

function fillTunnelForm(form) {
    let row = window.localStorage.getItem('themes_suggest')
    const suggestions = row ? JSON.parse(row) : {}

    row = window.localStorage.getItem('lessons_answer')
    const lessonsAnswer = row ? JSON.parse(row) : {}

    for (const key in suggestions) {

        const radios = form.querySelectorAll(`.radio[name="${key}"]`)

        if (!radios.length) continue;

        const answer = radios[0].closest('.form-question__variants2').dataset.answer

        if (suggestions[key] == 'yes') {
            radios[0].checked = true
        } else if (suggestions[key] == 'no') {
            radios[1].checked = true
        } else if (suggestions[key] == 'unknow') {
            radios[2].checked = true
        }

    }

    for (const key in lessonsAnswer) {
        const radios = form.querySelectorAll(`.radio[name="${key}"]`)

        if (!radios.length) continue;

        radios.forEach((radio) => {
            radio.checked = radio.value == lessonsAnswer[key] ? true : false
        })
    }
}

function addSuggestions(form) {

    const formBlocks = form.querySelectorAll('.js-main-quest')

    const row = window.localStorage.getItem('themes_suggest')
    const suggestions = row ? JSON.parse(row) : {}

    formBlocks.forEach((block) => {

        const answer = block.dataset.answer
        const radioBtn = block.querySelector('.radio:checked')
        const radioValue = radioBtn.value
        const radioKey = radioBtn.name

        if (radioValue == 'yes') {
            suggestions[radioKey] = 'yes';
        } else if (radioValue == 'no') {
            suggestions[radioKey] = 'no';
        } else if (radioValue == 'unknow') {
            suggestions[radioKey] = 'unknow';
        }
    })

    window.localStorage.setItem('themes_suggest', JSON.stringify(suggestions))

    // Save Data to database
    if ($("body").hasClass('logged-in')) {
        saveLocalStorageDataToDB('themes_suggest')
    }
    // window.location.href = "/my-progress"
}

function saveLessonsAnswer(form) {

    const formBlocks = form.querySelectorAll('.js-sec-quest')

    const row = window.localStorage.getItem('lessons_answer')
    const lessonsAnswer = row ? JSON.parse(row) : {}

    formBlocks.forEach((block) => {
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

function isFormCompleted(form) {
    const questions = form.querySelectorAll('.form-question__variants')
    const radios = form.querySelectorAll('.radio')
    const btn = form.querySelector('.tunnel__button')

    let isBtnDisabled = checkTunnelForm(questions)
    btn.disabled = isBtnDisabled

    radios.forEach((radio) => radio.addEventListener('change', () => {
        isBtnDisabled = checkTunnelForm(questions)

        btn.disabled = isBtnDisabled
    }))
}

function checkTunnelForm(questions) {

    let isBtnDisabled = false

    questions.forEach(
        (block) => { if (!block.querySelector('.radio:checked')) isBtnDisabled = true }
    )

    return isBtnDisabled
}



/*
 * ---------------------------Push notifications--------------------------------
 */

firebase.initializeApp({
    apiKey: "AIzaSyBCwBJ8w59UZSVe8cSus5s-2qiTi3J5aHQ",
    authDomain: "real-good-help-d42ac.firebaseapp.com",
    projectId: "real-good-help-d42ac",
    storageBucket: "real-good-help-d42ac.appspot.com",
    messagingSenderId: "194534504607",
    appId: "1:194534504607:web:d42817622c694fcc494aaa"
})

const messaging = firebase.messaging()

messaging.onMessage((payload) => {
    const notOption = {
        body: payload.notification.body,
        icon: payload.notification.icon
    }

    if (Notification.permission == 'granted') {
        const notification = new Notification(payload.notification.title, notOption)

        notification.addEventListener('click', (e) => {
            e.preventDefault()

            window.open(payload.notification.click_action, '_blank')
            notification.close()
        })
    }
})



/*
 * ---------------------------Reminder--------------------------------
 */

if (document.querySelector('.reminder__form')) reminderInit();

function reminderInit() {
    const form = document.querySelector('.reminder__form')
    const addBtn = form.querySelector('.readmore__add-button')
    const removeBtns = form.querySelectorAll('.reminder__remove-button')
    const tabsContainer = form.querySelector('.tabs-container')
    const tabsBlock = tabsContainer.querySelector('.tabs')
    const tabs = tabsBlock.querySelectorAll('.tab')
    const tabsContent = tabsContainer.querySelector('.tabs__content')
    const notifCheck = tabsContent.querySelector('.check__input[name="notifications"]')
    const searchParams = new URLSearchParams(window.location.search)

    if (searchParams.has('success')) showPopup('suc-reminder');

    addBtn.addEventListener('click', () => reminderAddRow(form))
    removeBtns.forEach((btn) => btn.addEventListener('click', remiderRemoveRow))

    tabs.forEach((tab) => tab.addEventListener('input', () => {
        const prev = tabsContent.querySelector('.req-field')
        prev.classList.remove('req-field')
        if (prev.querySelector('.empty')) prev.querySelector('.empty').classList.remove('empty');

        tabsContent.querySelector(`#${tab.dataset.tabItem}`).classList.add('req-field')
    }))

    if(notifCheck){
        notifCheck.addEventListener('input', () => messaging.requestPermission())
    }

    form.addEventListener('submit', (e) => sendReminder(e, form))
}

function reminderAddRow(form) {
    const container = form.querySelector('.reminder__fields')
    const temp = container.querySelector('#reminder-temp').content

    const row = temp.cloneNode(true)
    row.querySelector('.reminder__remove-button').addEventListener('click', remiderRemoveRow)

    container.append(row)
}
async function remiderRemoveRow(e) {
    const btn = e.target.closest('.reminder__remove-button')
    const row = btn.closest('.reminder__form-row')
    const container = row.closest('.reminder__fields')
    const reminderId = row.querySelector('input[name="reminder_id[]"]').value

    if (reminderId) {
        const formData = new FormData()
        formData.append('id', reminderId)
        formData.append('action', 'remove_reminder')

        fetch(rlghData.ajaxurl, {
            method: 'POST',
            body: formData,
        })
    }

    btn.removeEventListener('click', remiderRemoveRow)
    row.remove()

    const rows = container.querySelectorAll('.reminder__form-row')
    if (rows.length == 1) {
        rows[0].querySelector('.reminder__remove-button').classList.add('single')
    }
}

async function sendReminder(e, form) {
    e.preventDefault()

    const notifCheck = form.querySelector('.check__input[name="notifications"]')
    if (Notification.permission != 'granted') notifCheck.checked = false;

    if (!formValidation(form)) return;

    document.querySelector('#loader').style.display = '';

    const formData = new FormData(form)

    if (!formData.get('timezone')) {
        formData.set('timezone', Intl.DateTimeFormat().resolvedOptions().timeZone)
        formData.append('save_timezone', true)
    }
    if (formData.get('method') == 'push') {
        const token = await messaging.requestPermission()
            .then(() => { return messaging.getToken() })

        formData.append('token', token)
    }

    formData.append('action', 'reminder')

    const response = await fetch(rlghData.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(r => { return r })

    document.querySelector('#loader').style.display = 'none';

    if (!response.success) {
        alert('Some error. Please try again')
    } else {

        if ($("body").hasClass("category")) {
            // If request is coming from the category page
            showPopup('suc-reminder');
        } else {
            // if request is coming from Reminder page
            window.location.replace(window.location.href + '&success=true');
        }

    }
}



/*
 * ---------------------------suggestion--------------------------------
 */
if (document.querySelector('#theme-temp')) {
    if (
        window.localStorage.getItem('themes_suggest') &&
        Object.keys(
            JSON.parse(window.localStorage.getItem('themes_suggest'))
        ).length
    ) {
        const themesBlock = document.querySelector('.popup__theme-cards')
        const suggestBlock = document.querySelector('.suggestion')
        let isSuggestionEmty = true

        const row = window.localStorage.getItem('themes_suggest')
        const suggestions = JSON.parse(row)

        for (const key in suggestions) {
            if (suggestions[key] == 'no') continue;
            if (!themesBlock.querySelector(`.theme__card[data-theme="${key}"]`)) continue;

            if (!isThemeExist(key, 'current')) {
                insertTheme(key, 'suggestion')
                isSuggestionEmty = false
            }
        }

        if (!isSuggestionEmty) suggestBlock.classList.add('show')
    }
}


/*
 * ---------------------------Show saved themes on self help--------------------------------
 */
if (document.querySelector('#theme-temp')) {
    if (
        window.localStorage.getItem('themes_added') &&
        JSON.parse(window.localStorage.getItem('themes_added')).length
    ) {
        const currentThemes = document.querySelector('.current')
        const themesBlock = document.querySelector('.popup__theme-cards')

        const row = window.localStorage.getItem('themes_added')
        const themesId = JSON.parse(row)

        themesId.forEach((id) => {
            if (!themesBlock.querySelector(`.theme__card[data-theme="${id}"]`)) return;
            themesBlock
                .querySelector(`.theme__card[data-theme="${id}"]`)
                .classList.add('checked')

            insertTheme(id, 'current')
        })

        currentThemes.classList.add('show')
        document.querySelector('.za-goals-content').classList.remove('show')
    } else {
        document.querySelector('.za-goals-content').classList.add('show')
    }
}





// Header Theme Cards Navigation
if (document.querySelector('#menu-menu-1') || document.querySelector('#menu-wellbeing_menu')) {

    // Show header theme cards on Self-Help Menu Item hover
    let self_help_menu_item = "";
    if (document.querySelector('#menu-menu-1')) {
        if (document.querySelector('#menu-menu-1 :nth-child(3)').textContent == "Self Help") {
            self_help_menu_item = document.querySelector('#menu-menu-1 :nth-child(3)');
        }
    } else if (document.querySelector('#menu-wellbeing_menu')) {
        if (document.querySelector('#menu-wellbeing_menu :nth-child(1)').textContent == "Self Help") {
            self_help_menu_item = document.querySelector('#menu-wellbeing_menu :nth-child(1)');
        }
    }

    if (self_help_menu_item) {
        var setTimeToHide_ID;
        var timeOutValue = 400;
        const headerThemesPopup = document.querySelector('.themes_popup_header');
        self_help_menu_item.addEventListener('mouseover', function handleMouseOver() {
            headerThemesPopup.classList.add('show');
            if (setTimeToHide_ID) {
                window.clearTimeout(setTimeToHide_ID);
                setTimeToHide_ID = 0;
            }
        });
        headerThemesPopup.addEventListener('mouseover', function handleMouseOver(e) {
            if (setTimeToHide_ID) {
                window.clearTimeout(setTimeToHide_ID);
                setTimeToHide_ID = 0;
            }
        });
        self_help_menu_item.addEventListener('mouseout', function handleMouseOver() {
            setTimeToHide_ID = window.setTimeout(function() {
                headerThemesPopup.classList.remove('show');
            }, timeOutValue);
        });
        headerThemesPopup.addEventListener('mouseout', function handleMouseOver() {
            setTimeToHide_ID = window.setTimeout(function() {
                headerThemesPopup.classList.remove('show');
            }, timeOutValue);
        });

        // Adding check to stored themes on header themes popup
        const row = window.localStorage.getItem('themes_added')
        const themesId = JSON.parse(row)
        const themesBlock = document.querySelector('.popup__theme-cards-header')
        if (themesId !== null) {
            themesId.forEach((id) => {
                if (!themesBlock.querySelector(`.theme__card[data-theme="${id}"]`)) return;
                themesBlock
                    .querySelector(`.theme__card[data-theme="${id}"]`)
                    .classList.add('checked')
            })
        }

        // Storing themes to localstorge and Redirecting to relevant cateory page
        const cardsBlock = document.querySelector('.popup__theme-cards-header')
        const themeCards = cardsBlock.querySelectorAll('.theme__card-header')
        themeCards.forEach((card) => card.addEventListener('click', () => {
            const themeId = card.dataset.theme

            card.classList.toggle('checked')

            if (card.classList.contains('checked')) {
                addThemeToStorage(themeId)
            } else {
                // removeThemeFromStorage(themeId)
                card.classList.add('checked')
            }
            window.location.href = card.dataset.catUrl;
        }))
    }
}






// My Progress page themes card

if (document.querySelector('.popup__theme-cards')) {
    themeCardsInit()
}


function themeCardsInit() {
    const currentThemes = document.querySelector('.current')
    const suggestThemes = document.querySelector('.suggestion')
    const themesBlock = currentThemes.querySelector('.theme__cards')
    const cardsBlock = document.querySelector('.popup__theme-cards')
    const themeCards = cardsBlock.querySelectorAll('.theme__card')

    themeCards.forEach((card) => card.addEventListener('click', () => {
        const themeId = card.dataset.theme

        card.classList.toggle('checked')

        if (card.classList.contains('checked')) {
            insertTheme(themeId, 'current')
            addThemeToStorage(themeId)
            document.querySelector('.za-goals-content').classList.remove('show')

            if (isThemeExist(themeId, 'suggestion')) {
                suggestThemes.querySelector(`.theme__readmore[data-theme="${themeId}"]`).remove()
            }
        } else {
            themesBlock.querySelector(`.theme__readmore[data-theme="${themeId}"]`).remove()
            removeThemeFromStorage(themeId)

            if (isSuggestThemeExist(themeId)) {
                insertTheme(themeId, 'suggestion')
            }
        }
        $('.themes__popup').removeClass('show');
        unlockScroll();
        isCurrentEmpty();

        if (isCurrentEmpty()) {
            document.querySelector('.za-goals-content').classList.add('show')
        } else {
            document.querySelector('.za-goals-content').classList.remove('show')
        }
    }))
}

$(document).on("click", ".remove_theme__button", function() {

    let crnt = $(this);
    let themeId = crnt.parents(".theme__readmore").attr("data-theme");

    removeThemeFromStorage(themeId);

    crnt.parents(".theme__readmore").remove();

    $('.theme__card[data-theme="' + themeId + '"]').removeClass("checked");

    isCurrentEmpty();

    if (isCurrentEmpty()) {
        document.querySelector('.za-goals-content').classList.add('show')
    } else {
        document.querySelector('.za-goals-content').classList.remove('show')
    }
});

function addThemeToStorage(id) {
    const row = window.localStorage.getItem('themes_added')
    const themesId = row ? JSON.parse(row) : []
    if (themesId.indexOf(id) !== -1) {
        // the themeId alredy exists!
    } else {
        themesId.push(id)
    }

    window.localStorage.setItem('themes_added', JSON.stringify(themesId))

    // Save Data to database
    if ($("body").hasClass('logged-in')) {
        saveLocalStorageDataToDB('themes_added')
    }
}

function removeThemeFromStorage(id) {
    const row = window.localStorage.getItem('themes_added')
    const themesId = JSON.parse(row)

    const idx = themesId.findIndex((themeId) => themeId == id)
    themesId.splice(idx, 1)

    window.localStorage.setItem('themes_added', JSON.stringify(themesId))


    // Save Data to database
    if ($("body").hasClass('logged-in')) {
        saveLocalStorageDataToDB('themes_added')
    }
}

function isCurrentEmpty() {
    const currentThemes = document.querySelector('.current')
    const popup = document.querySelector('.themes__popup')

    if (currentThemes.querySelector('.theme__readmore')) {
        currentThemes.classList.add('show')

        return false;
    } else {
        currentThemes.classList.remove('show')

        return true;
    }
}

function isSuggestionEmpty() {
    const suggestThemes = document.querySelector('.suggestion')

    if (suggestThemes.querySelector('.theme__readmore')) {
        suggestThemes.classList.add('show')

        return false;
    } else {
        suggestThemes.classList.remove('show')

        return true;
    }
}

function insertTheme(id, container) {
    const cardsBlock = document.querySelector('.popup__theme-cards')
    const card = cardsBlock.querySelector(`.theme__card[data-theme="${id}"]`)
    const themesContainer = document.querySelector(`.${container}`)
    const themesBlock = themesContainer.querySelector('.theme__cards')
    const themeTemp = document.querySelector('#theme-temp')

    const themeCard = themeTemp.content.querySelector('.theme__readmore')
    const themeImg = themeTemp.content.querySelector('.bg-block')
    const themeName = themeTemp.content.querySelector('.theme__name')
    const themeLink = themeTemp.content.querySelector('.blue-button')

    const img = card.querySelector('.img').src
    const name = card.querySelector('.theme__text').innerHTML
    let catUrl = card.dataset.catUrl
    if (cardsBlock.classList.contains('active')) catUrl += '?tutorial=true';

    themeCard.dataset.theme = id
    themeImg.src = img
    themeName.innerHTML = name
    themeLink.href = catUrl

    const theme = themeTemp.content.cloneNode(true)
    themesBlock.append(theme)
}

function isThemeExist(id, container) {
    const themesBlock = document.querySelector(`.${container}`)

    return !!themesBlock.querySelector(`.theme__readmore[data-theme="${id}"]`)
}

function isSuggestThemeExist(id) {
    const row = window.localStorage.getItem('themes_suggest')
    const suggestions = JSON.parse(row)
    let isExist = false

    for (const key in suggestions) {
        if (key == id && suggestions[key] == 'yes') isExist = true;
    }

    return isExist
}
if (document.querySelector('#theme-temp')) {
    readMoreInit()
}

function readMoreInit() {
    $(document).on("click", ".show-readmore-content", function() {
        var crnt = $(this);

        if (!crnt.parents('section').hasClass('my-strategies__content')) {
            // redirecting the them card to category page
            window.location.href = crnt.parents(".theme__readmore").find(".za-theme-more-btn").attr("href");
            return false;
        } else {
            const btn = crnt.parents(".card").find(".readmore__button")
            btn.toggleClass('show')

            if (btn.hasClass('show')) {
                crnt.parents(".readmore").css("max-height", 'max-content')
            } else {
                crnt.parents(".readmore").css("max-height", '')
            }
        }

    })
}

// Goals counter on my progress page
$(document).on("click", ".za-counter-add", function() {
    let crnt = $(this);
    let new_count = parseInt(crnt.parents(".za-count-box").find(".za-counter-box-count").html()) + 1;
    crnt.parents(".za-count-box").find(".za-counter-box-count").html(new_count);
});
$(document).on("click", ".za-counter-minus", function() {
    let crnt = $(this);
    let new_count = parseInt(crnt.parents(".za-count-box").find(".za-counter-box-count").html()) - 1;
    if (new_count !== -1) {
        crnt.parents(".za-count-box").find(".za-counter-box-count").html(new_count);
    }
});



/*
 * ---------------------------tutorial--------------------------------
 */
if (document.querySelector('.tutorial__button')) {
    tutorialInit()
}

function tutorialInit() {
    const btns = document.querySelectorAll('.tutorial__button')
    let next, hint

    btns.forEach((btn) => {
        next = btn
        btn.addEventListener('click', () => tutorialNextStep())
    })

    function tutorialNextStep() {
        if (!next.classList.contains('tutorial__button')) {
            next.classList.remove('active');
            next.removeEventListener('click', tutorialNextStep)
            if (hint) hint.classList.remove('active');
        }

        if (!next.dataset.step) return;
        hint = document.querySelector(`.tutorial__hint.${next.dataset.step}`)
        next = document.querySelector(`.tutorial__item.${next.dataset.step}`)
        if (hint) hint.classList.add('active');
        next.classList.add('active')

        next.addEventListener('click', tutorialNextStep)
    }
}

// Script code for template-my-strategies.php file
/*
 * ---------------------------my-strategies--------------------------------
 */

if (document.querySelector('.my-strategies')) {
    fillLessons()
}

async function fillLessons() {
    const container = document.querySelector('.my-strategies__content')
    const currentPage = container.dataset.page
    const row = window.localStorage.getItem('saved_lessons')
    const lessonsId = row ? JSON.parse(row) : []

    $(document).ready(function() {
        jQuery.ajax({
            type: "post",
            url: rlghData.ajaxurl,
            data: {
                action: "saved",
                lessons: lessonsId,
                page: currentPage
            },
            success: function(response) {
                container.innerHTML = response
            },
            error: function() {
                // $('#loader').hide();
            }
        });
    })
}


/*
 * ---------------------------buttons--------------------------------
 */
if (document.querySelector('.js-back')) {
    const btns = document.querySelectorAll('.js-back')

    btns.forEach((btn) => btn.addEventListener('click', () => window.history.back()))
}

/*
 * ------------------------Send-suggestion-----------------------------
 */
if (document.querySelector('.suggestion__form')) {
    sendSuggestionInit()
}

function sendSuggestionInit() {
    const form = document.querySelector('.suggestion__form')

    form.addEventListener('submit', (e) => sendSuggestion(e, form))
}

async function sendSuggestion(e, form) {
    e.preventDefault()

    document.documentElement.classList.add('loading')

    const formData = new FormData(form)
    formData.append('action', 'suggestion')

    fetch(rlghData.ajaxurl, {
            method: 'POST',
            body: formData,
        })
        .then(response => { form.reset() })
        .then(response => { showPopup('success') })
        .then(response => { document.documentElement.classList.remove('loading') })
        .catch(error => { console.error('Error:', error) })
}



/*
 * ------------------------Common-----------------------------
 */
function getNumber(str) {
    return +str.replace(/[^+\d]/g, "");
}

function getScrollWidth() {
    return window.innerWidth - document.documentElement.clientWidth;
}

function getRealHeight(parent, count = null) {
    const children = parent.children;

    let sum = 0;
    let bot = 0;
    let i = 0;

    for (let child of children) {
        if (count && i >= count) break;
        sum += child.clientHeight;

        if (bot) sum += child.getBoundingClientRect().top - bot;
        bot = child.getBoundingClientRect().bottom;

        i++;
    }

    return sum;
}

function getDevice() {
    return innerWidth > 1000 ? "desktop" : "mobile";
}

function getFileExtension(fileName) {
    const parts = fileName.split('.')
    return parts[parts.length - 1]
}

function formatTime(hours, min = 0, separator = '') {
    let minutes = ''
    if (min != 0) {
        minutes = ':' + leadingZero(min)
    }

    if (hours == 0) return `12${minutes}${separator}am`;
    if (hours == 12) return `${hours}${minutes}${separator}pm`;

    const dayTime = hours > 12 ? 'pm' : 'am'
    return `${hours % 12}${minutes}${separator}${dayTime}`
}

function leadingZero(time) {
    return ('0' + time).slice(-2)
}

function parseTime(strTime) {
    const numbs = strTime.replace(/\D/g, '')
    return [+numbs.slice(0, 2), +numbs.slice(2, 4)]
}

function uppFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function getSizeFromBytes(size, target = null) {
    if (target) {
        switch (target) {
            case 'KB':
                return +(size /= 1024).toFixed(1);
            case 'MB':
                return +(size /= Math.pow(1024, 2)).toFixed(1);
            case 'GB':
                return +(size /= Math.pow(1024, 3)).toFixed(1);
        }
    }

    if (size < 1024) return size.toFixed(1) + ' B';

    size /= 1024
    if (size < 1024) return size.toFixed(1) + ' KB';

    size /= 1024
    if (size < 1024) return size.toFixed(1) + ' MB';

    size /= 1024
    if (size < 1024) return size.toFixed(1) + ' GB';
}

function convertFormToJSON(form) {
    return $(form)
        .serializeArray()
        .reduce(function(json, { name, value }) {
            json[name] = value;
            return json;
        }, {});
}

function totalPrice() {
    var initPrice = jQuery('#initPrice').html();
    var discount = jQuery('#discountPrice').html();
    var total = initPrice - discount;
    return total.toFixed(2);
}
async function sendForm(form, action) {
    if (!formValidation(form)) return false;

    const formData = new FormData(form)
    formData.append('action', action)

    return await fetch(rlghData.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(r => { return r })
}


$('.book_button_steps').click(function() {
    var dataStep = $(this).data('step');
    if (dataStep == 5) {
        var stepFormData = convertFormToJSON('#bookingForm');
        var commuMethodArray = stepFormData.type_price.split('#');
        console.log(stepFormData, commuMethodArray);
        jQuery('#commuMethodType').html(commuMethodArray[1]);
        jQuery('#initPrice').html(commuMethodArray[0]);
        jQuery('#commuMethodPeriod').html(commuMethodArray[2]);
        jQuery('#videoType').html(stepFormData.communication_method);
        jQuery('#totalPrice, #btnLblPrice').html(totalPrice());

        //Update Booking Time and Date

        const timezone = +document.getElementById('timezone').value
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];
        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        var booking_date = $('#session_date').val();
        var booking_start = $('#session_start').val();
        var booking_end = $('#session_end').val();

        const stTime = new Date(`${booking_date}T${booking_start}`)
        const endTime = new Date(`${booking_date}T${booking_end}`)
        stTime.setMinutes(stTime.getMinutes() + timezone)
        endTime.setMinutes(endTime.getMinutes() + timezone)
        var month = stTime.getUTCMonth()
        var day = stTime.getUTCDay()
        var date = stTime.getUTCDate()

        var strtHours = formatTime(stTime.getHours(), stTime.getMinutes(), ' ')
        var endHours = formatTime(endTime.getHours(), endTime.getMinutes(), ' ')
        $('#fullDateFormate').html(days[day] + ', ' + monthNames[month] + ' ' + date + ', ' + strtHours + ' - ' + endHours);
    }
})

$("#checkout-button").click(function(e) {
    e.preventDefault();
    var stepFormData = convertFormToJSON('#bookingForm');

    jQuery.ajax({
        type: "post",
        dataType: "json",
        url: rlghData.ajaxurl,
        data: { action: "createSessionStripe", data: stepFormData },
        beforeSend: function() {
            $('#loader').show();
        },
        success: function(response) {
            if (response.success == true) {
                window.location.replace(response.message);
            } else {
                $('#loader').hide();
                alert(response.message);
            }
        },
        error: function() {
            $('#loader').hide();
        }
    });
});


$("input[name=payment_method]").change(function() {
    $('#smart-button-container').toggle();
    $('#checkout-button').toggle();
});

function initPayPalButton() {
    paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'blue',
            layout: 'vertical',
            label: 'pay',
        },

        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{ "amount": { "currency_code": rlghData.currency, "value": 1 } }]
            });
        },

        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {

                // Full available details
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                // Show a success message within this page, e.g.
                //const element = document.getElementById('paypal-button-container');
                //element.innerHTML = '';
                //element.innerHTML = '<h3>Thank you for your payment!</h3>';

                // Or go to another URL:
                actions.redirect('/thank-you/');
            });
        },

        onError: function(err) {
            actions.redirect('/cancel/');
        }
    }).render('#paypal-button-container');
}

//Remove the success Message
$(document).ready(function() {
    setTimeout(() => {
        $('p.successMsg').remove();
    }, 5000);
});

//'Another option' enable when checkbox 'Other' checked

if (document.getElementById('step-3_other')) {
    document.getElementById('step-3_other').onchange = function() {
        document.getElementById('another_options').disabled = !this.checked
    }
}

// 'Other main method' enable when checkbox 'Other' checked

if (document.getElementById('step-3_my_main_other')) {
    const radios = document.querySelectorAll('.check__input[name="main_method[]"]')
    const other = document.getElementById('step-3_my_main_other')

    radios.forEach((radio) => radio.addEventListener('input', () => {
        document.getElementById('other_main_method').disabled = !other.checked
    }))
}

$("[id^='cancel_session-']").click(function() {
    var cancel_payment_key = $(this).attr('id');
    $('.js-yes-popup').attr('data-cancel-session-id', cancel_payment_key);
});

$(".js-yes-popup").click(function() {
    var cancel_payment_key = $(this).attr('data-cancel-session-id');
    var client_id = $('#' + cancel_payment_key).attr('data-client-id');
    var therapist_id = $('#' + cancel_payment_key).attr('data-therapist-id');
    var cancelled_by = $('#' + cancel_payment_key).attr('data-cancelled-by');
    var payment_key = $('#' + cancel_payment_key).attr('data-session-id');

    $.ajax({
        method: "POST",
        url: rlghData.ajaxurl,
        data: { action: "session_cancel", payment_key: payment_key, client_id: client_id, therapist_id: therapist_id, cancelled_by: cancelled_by },
        beforeSend: function() {
            $('#loader').show();
        },
        dataType: "JSON",
        success: function(response) {
            console.log(response);
            if (response.success == 'Successfully Cancelled') {
                window.location.reload();
            }
        }
    });
});

$(".js-redeem-btn").click(function(e) {
    e.preventDefault();
    var coupon_code = $('#promo_field').val();
    console.log(coupon_code);
    if (coupon_code) {
        $('#promo_field').css("border-color", "#e8e8e8");
        $.ajax({
            method: "POST",
            url: rlghData.ajaxurl,
            data: { action: "redeem_promo_code", coupon_code: coupon_code },
            beforeSend: function() {
                $('#loader').show();
            },
            dataType: "JSON",
            success: function(response) {
                $('#loader').hide();
                if (response.error) {
                    alert(response.error);
                    $('#promo_amount').val("");
                    $('#discountPrice').text("0.00");
                    $('#totalPrice').text($('#initPrice').text());
                    $('#btnLblPrice').text($('#initPrice').text());
                } else if (response.success == 'Success') {
                    var total_price = parseInt($('#initPrice').text());
                    var discount_price = parseInt(response.data.percentage_amount) * total_price / 100;
                    var new_total_price = total_price - discount_price;
                    var promo_value = discount_price + '#' + response.data.id;
                    $('#promo_amount').val(promo_value);
                    $('#discountPrice').text(discount_price);
                    $('#totalPrice').text(new_total_price);
                    $('#btnLblPrice').text(new_total_price);
                }
            }
        });
    } else {
        $('#promo_field').css("border-color", "red");
        $('#promo_amount').val("");
        $('#discountPrice').text("0.00");
        $('#totalPrice').text($('#initPrice').text());
        $('#btnLblPrice').text($('#initPrice').text());
    }
});








/*
 * ----------------Save User Progress in database starts here---------------------
 * ----------------Save User Progress in database starts here---------------------
 * ----------------Save User Progress in database starts here---------------------
 */


jQuery(document).ready(function($) {
    if (!$("body").hasClass('logged-in') &&
        ($('body').hasClass('category') || $('body').hasClass('page-template-template-my-strategies')) &&
        window.localStorage.getItem('login_popup_showed') === null
    ) {
        showPopup('login');
        window.localStorage.setItem('login_popup_showed', "yes")
    }
})

function saveLocalStorageDataToDB(dataType) {
    $('#loader').show();
    $.ajax({
            method: 'POST',
            url: rlghData.ajaxurl,
            data: {
                action: 'user_save_progress',
                data_type: dataType,
                data: $.trim(window.localStorage.getItem(dataType))
            },
        })
        .done(function(response) {
            console.log(response.data.response)
            $('#loader').hide();
        })
        .fail(function(error) {
            console.log(error)
        })
}

function getSavedLocalStorageDataFromDB(dataType) {
    var respone
    $.ajax({
            method: 'POST',
            url: rlghData.ajaxurl,
            async: false,
            data: {
                action: 'user_get_saved_progress',
                data_type: dataType
            },
            dataType: 'JSON'
        })
        .done(function(response) {
            respone = response.data.DB_data
        })
        .fail(function(error) {
            console.log(error)
        })
    return respone
}

function ifUserLoggedIn() {
    var response
    $.ajax({
            method: 'POST',
            url: rlghData.ajaxurl,
            async: false,
            data: {
                action: 'check_user_logged_in'
            }
        })
        .done(function(data) {
            response = data
        })
        .fail(function(error) {
            console.log(error)
        })
    return response
}


/*
 * ----------------Save User Progress in database ends here---------------------
 * ----------------Save User Progress in database ends here---------------------
 * ----------------Save User Progress in database ends here---------------------
 */