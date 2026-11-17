/* ===================================
    1) header.php
    2)index.php
    3)footer.php
========================================*/

/* ======================
    1) header.php
=========================*/

//   function toggleMenu(){
//     const menu = document.getElementById("menu")

//     if(menu.classList.contains("navActive")){
//         menu.classList.remove("navActive")
//     } else {
//         menu.classList.add("navActive")
//     }
// }
function toggleMenu () {
  const menu = document.getElementById('menu')
  const navRight = document.getElementById('navRight')

  menu.classList.toggle('navActive')
  navRight.classList.toggle('navActive')
}

document.addEventListener('DOMContentLoaded', () => {

  const faqBtns = document.querySelectorAll('.faq-question')

  if (!faqBtns.length) return

  faqBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.parentElement
      const isOpen = item.classList.contains('active')

      document.querySelectorAll('.faq-item').forEach(i => {
        i.classList.remove('active')
      })

      if (!isOpen) {
        item.classList.add('active')
      }
    })
  })
})

// ===================================================carosal=====================

document.addEventListener('DOMContentLoaded', function () {
  const tabs = document.querySelectorAll('.dashboard-tab')
  const title = document.querySelector('.content-header h3')
  const subtitle = document.querySelector('.content-header p')
  const note = document.querySelector('.dashboard-note')
  const leftBtn = document.querySelector('.slider-arrow.left')
  const rightBtn = document.querySelector('.slider-arrow.right')

  const slides = [
    {
      title: 'Invoice Management',
      subtitle: 'Manage all your customer invoices',
      note: 'Create professional, GST-compliant invoices with automatic calculations'
    },
    {
      title: 'Inventory Dashboard',
      subtitle: 'Track stock levels and low inventory alerts',
      note: 'Monitor gold, silver, and jewellery stock in real time'
    },
    {
      title: 'Business Analytics',
      subtitle: 'Analyze sales, profit, and business performance',
      note: 'Get powerful reports and insights to grow your business'
    }
  ]

  let current = 0
  let autoSlide

  function updateSlide (index) {
    // Update active tab
    tabs.forEach(tab => tab.classList.remove('active'))
    tabs[index].classList.add('active')

    // Update heading/subtitle/note only
    title.textContent = slides[index].title
    subtitle.textContent = slides[index].subtitle
    note.textContent = slides[index].note

    current = index
  }

  function nextSlide () {
    const next = (current + 1) % slides.length
    updateSlide(next)
  }

  function prevSlide () {
    const prev = (current - 1 + slides.length) % slides.length
    updateSlide(prev)
  }

  function startAutoSlide () {
    autoSlide = setInterval(nextSlide, 4000)
  }

  function restartAutoSlide () {
    clearInterval(autoSlide)
    startAutoSlide()
  }

  // Tab click
  tabs.forEach((tab, index) => {
    tab.addEventListener('click', function () {
      updateSlide(index)
      restartAutoSlide()
    })
  })

  // Left arrow
  if (leftBtn) {
    leftBtn.addEventListener('click', function () {
      prevSlide()
      restartAutoSlide()
    })
  }

  // Right arrow
  if (rightBtn) {
    rightBtn.addEventListener('click', function () {
      nextSlide()
      restartAutoSlide()
    })
  }

  // Initialize
  updateSlide(0)
  startAutoSlide()
})
// ==================poup=======

function openAuthPopup () {
  document.getElementById('authPopup').classList.add('active')
  document.body.style.overflow = 'hidden'
}

function closeAuthPopup () {
  document.getElementById('authPopup').classList.remove('active')
  document.body.style.overflow = ''
}

// Close popup on ESC key
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    closeAuthPopup()
  }
})

// Toggle password visibility
document.addEventListener('DOMContentLoaded', function () {
  const togglePassword = document.querySelector('.toggle-password')
  const passwordInput = document.querySelector('input[type="password"]')

  togglePassword.addEventListener('click', function () {
    // Toggle input type
    const isPassword = passwordInput.type === 'password'
    passwordInput.type = isPassword ? 'text' : 'password'

    // Toggle eye icon
    this.classList.toggle('fa-eye')
    this.classList.toggle('fa-eye-slash')
  })
})
// =============pricing===========

const revealTitle = document.querySelector('.reveal-title')
const revealTable = document.querySelector('.reveal-table')

function revealCompareSection () {
  const trigger = window.innerHeight * 0.85

  if (revealTitle.getBoundingClientRect().top < trigger) {
    revealTitle.classList.add('show')
  } else {
    revealTitle.classList.remove('show')
  }

  if (revealTable.getBoundingClientRect().top < trigger) {
    revealTable.classList.add('show')
  } else {
    revealTable.classList.remove('show')
  }
}

window.addEventListener('scroll', revealCompareSection)

window.addEventListener('load', revealCompareSection)
/* ================= WHY SECTION ANIMATION ================= */

const whyTitle = document.querySelector('.why-title')
const whyCards = document.querySelectorAll('.why-reveal-card')
const whyStats = document.querySelector('.why-stats')

function revealWhySection () {
  const trigger = window.innerHeight * 0.88

  /* TITLE */

  if (whyTitle) {
    if (whyTitle.getBoundingClientRect().top < trigger) {
      whyTitle.classList.add('show')
    } else {
      whyTitle.classList.remove('show')
    }
  }

  /* CARDS */

  whyCards.forEach((card, index) => {
    if (card.getBoundingClientRect().top < trigger) {
      setTimeout(() => {
        card.classList.add('show')
      }, index * 120)
    } else {
      card.classList.remove('show')
    }
  })

  /* STATS */

  if (whyStats) {
    if (whyStats.getBoundingClientRect().top < trigger) {
      whyStats.classList.add('show')
    } else {
      whyStats.classList.remove('show')
    }
  }
}
window.addEventListener('scroll', revealWhySection)
window.addEventListener('load', revealWhySection)

/* ================= TESTIMONIAL ANIMATION ================= */
;(function () {
  const testimonialBadge = document.querySelector('.top-badge')
  const testimonialCard = document.querySelector('.testimonial-card')

  function revealTestimonialSection () {
    const trigger = window.innerHeight * 0.88

    if (testimonialBadge) {
      if (testimonialBadge.getBoundingClientRect().top < trigger) {
        testimonialBadge.classList.add('show')
      } else {
        testimonialBadge.classList.remove('show')
      }
    }

    if (testimonialCard) {
      if (testimonialCard.getBoundingClientRect().top < trigger) {
        testimonialCard.classList.add('show')
      } else {
        testimonialCard.classList.remove('show')
      }
    }
  }

  window.addEventListener('scroll', revealTestimonialSection)
  window.addEventListener('load', revealTestimonialSection)

  /* Run immediately */
  revealTestimonialSection()
})()
/* ================= FAQ FUNCTIONALITY ================= */

;(function () {
  const faqItems = document.querySelectorAll('.faq-item')

  faqItems.forEach((item) => {
    const button = item.querySelector('.faq-question')

    button.addEventListener('click', () => {
      if (item.classList.contains('active')) {
        item.classList.remove('active')
      } else {
        faqItems.forEach((faq) => {
          faq.classList.remove('active')
        })

        item.classList.add('active')
      }
    })
  })
})()

/* ================= SCROLL ANIMATION ================= */

;(function () {
  const faqTitle = document.querySelector('.faq-title')

  const faqRevealItems =
  document.querySelectorAll('.faq-reveal')

  const faqCta =
  document.querySelector('.faq-cta-reveal')

  function revealFaqSection () {
    const trigger = window.innerHeight * 0.88

    /* TITLE */

    if (faqTitle) {
      if (
        faqTitle.getBoundingClientRect().top < trigger
      ) {
        faqTitle.classList.add('show')
      } else {
        faqTitle.classList.remove('show')
      }
    }

    /* FAQ ITEMS */

    faqRevealItems.forEach((item, index) => {
      if (item.getBoundingClientRect().top < trigger) {
        setTimeout(() => {
          item.classList.add('show')
        }, index * 120)
      } else {
        item.classList.remove('show')
      }
    })

    /* CTA */

    if (faqCta) {
      if (faqCta.getBoundingClientRect().top < trigger) {
        faqCta.classList.add('show')
      } else {
        faqCta.classList.remove('show')
      }
    }
  }

  window.addEventListener('scroll', revealFaqSection)

  window.addEventListener('load', revealFaqSection)
})()

/* ================= FAQ SECTION REVEAL ANIMATION ================= */

document.addEventListener('DOMContentLoaded', function () {

  /* FAQ */

  const faqItems =
  document.querySelectorAll('.faq-item')

  faqItems.forEach((item) => {

    const button =
    item.querySelector('.faq-question')

    if (button) {
      button.addEventListener('click', function () {
        const isActive =
        item.classList.contains('active')

        /* CLOSE ALL */

        faqItems.forEach((faq) => {

          faq.classList.remove('active')
        })

        /* OPEN CLICKED */

        if (!isActive) {
          item.classList.add('active')
        }
      })
    }
  })

  /* ================= SCROLL ANIMATION ================= */

  const faqTitle =
  document.querySelector('.faq-title')

  const faqRevealItems =
  document.querySelectorAll('.faq-reveal')

  const faqCta =
  document.querySelector('.faq-cta-reveal')

  function revealFaqSection () {
    const trigger =
    window.innerHeight * 0.88

    /* TITLE */

    if (faqTitle) {
      if (
        faqTitle.getBoundingClientRect().top
        < trigger
      ) {
        faqTitle.classList.add('show')
      }else {
        faqTitle.classList.remove('show')
      }
    }

    /* FAQ ITEMS */

    faqRevealItems.forEach((item, index) => {

      if (
        item.getBoundingClientRect().top
        < trigger
      ) {
        setTimeout(() => {

          item.classList.add('show')
        }, index * 120)
      }else {
        item.classList.remove('show')
      }
    })

    /* CTA */

    if (faqCta) {
      if (
        faqCta.getBoundingClientRect().top
        < trigger
      ) {
        faqCta.classList.add('show')
      }else {
        faqCta.classList.remove('show')
      }
    }
  }

  /* EVENTS */

  window.addEventListener(
    'scroll',
    revealFaqSection
  )

  window.addEventListener(
    'load',
    revealFaqSection
  )

  revealFaqSection()
})
/* ========= SCROLL ANIMATION ========= */

/* ========= SCROLL ANIMATION ========= */

const cards = document.querySelectorAll('.reveal-card')

function revealCards () {
  cards.forEach((card, index) => {
    const top = card.getBoundingClientRect().top
    const trigger = window.innerHeight * 0.88

    if (top < trigger) {
      setTimeout(() => {
        card.classList.add('show')
      }, index * 180)
    } else {
      card.classList.remove('show')
    }
  })
}

window.addEventListener('scroll', revealCards)

window.addEventListener('load', revealCards)
/* ========= SCROLL ANIMATION ========= */

const section = document.querySelector('.pricing-hero')

function revealSection () {
  const trigger = window.innerHeight * 0.85
  const top = section.getBoundingClientRect().top

  if (top < trigger) {
    section.classList.add('active')
  } else {
    section.classList.remove('active')
  }
}

window.addEventListener('scroll', revealSection)

window.addEventListener('load', revealSection)

/* ========= ACTIVE CARD SWITCH ========= */

const pricingCards = document.querySelectorAll('.pricing-card')

pricingCards.forEach((card) => {
  card.addEventListener('click', () => {
    pricingCards.forEach((item) => {
      item.classList.remove('active-plan')
    })

    card.classList.add('active-plan')
  })
})
// ===============contact=============
;(function () {
  const contactReveal = document.querySelector('.contact-reveal')

  function revealContactHero () {
    const trigger = window.innerHeight * 0.88

    if (contactReveal) {
      if (contactReveal.getBoundingClientRect().top < trigger) {
        contactReveal.classList.add('show')
      } else {
        contactReveal.classList.remove('show')
      }
    }
  }

  window.addEventListener('scroll', revealContactHero)

  window.addEventListener('load', revealContactHero)
})()

;(function () {
  const contactLeft = document.querySelector('.contact-left-reveal')

  const contactCard = document.querySelector('.contact-card-reveal')

  function revealContactSection () {
    const trigger = window.innerHeight * 0.88

    if (contactLeft) {
      if (contactLeft.getBoundingClientRect().top < trigger) {
        contactLeft.classList.add('show')
      } else {
        contactLeft.classList.remove('show')
      }
    }

    if (contactCard) {
      if (contactCard.getBoundingClientRect().top < trigger) {
        contactCard.classList.add('show')
      } else {
        contactCard.classList.remove('show')
      }
    }
  }

  window.addEventListener('scroll', revealContactSection)

  window.addEventListener('load', revealContactSection)
})()

/* ==========================================
/* ==========================================
   CONTINUOUS LOOP COUNTER
   After reaching the target, it automatically
   restarts from 0 and counts forever.

   Works for:
   - .stat-item h4
   - .heroStats strong

   Supports:
   - 500+
   - 50K+
   - 99.9%
   - 5hrs
========================================== */

document.addEventListener('DOMContentLoaded', function () {
  const counters = document.querySelectorAll(
    '.stat-item h4, .heroStats strong'
  )

  // Format number exactly like the original text
  function formatValue (current, originalText) {
    const hasK = originalText.includes('K')
    const hasPlus = originalText.includes('+')
    const hasPercent = originalText.includes('%')
    const hasHours = originalText.toLowerCase().includes('hrs')
    const hasDecimal = originalText.includes('.')

    let value

    if (hasK) {
      value = Math.floor(current / 1000) + 'K'
    } else if (hasDecimal) {
      value = current.toFixed(1)
    } else {
      value = Math.floor(current).toString()
    }

    if (hasHours) {
      value += 'hrs'
    } else if (hasPercent) {
      value += '%'
    } else if (hasPlus) {
      value += '+'
    }

    return value
  }

  // Start infinite animation
  function startCounter (element) {
    const originalText =
    element.dataset.original || element.textContent.trim()

    element.dataset.original = originalText

    const numericValue = parseFloat(
      originalText.replace(/[^0-9.]/g, '')
    )

    if (isNaN(numericValue)) return

    const target = originalText.includes('K')
      ? numericValue * 1000
      : numericValue

    const duration = 90000 // 9 seconds

    function runAnimation () {
      const startTime = performance.now()

      function update (currentTime) {
        const elapsed = currentTime - startTime
        const progress = Math.min(elapsed / duration, 1)

        // Smooth easing
        const current = target * (1 - Math.pow(1 - progress, 3))

        element.textContent = formatValue(current, originalText)

        if (progress < 1) {
          requestAnimationFrame(update)
        } else {
          // Show exact final value
          element.textContent = originalText

          // Restart automatically after 1 second
          setTimeout(runAnimation, 1000)
        }
      }

      // Reset to zero before every cycle
      element.textContent = formatValue(0, originalText)

      requestAnimationFrame(update)
    }

    runAnimation()
  }

  // Start all counters immediately
  counters.forEach(function (counter) {
    startCounter(counter)
  })
})
// =========================== LOGIN POPUP ===========================

function openAuthPopup () {
  const authPopup = document.getElementById('authPopup')

  authPopup.style.display = 'flex'
  authPopup.classList.add('active')

  document.body.style.overflow = 'hidden'
}

function closeAuthPopup () {
  const authPopup = document.getElementById('authPopup')

  authPopup.classList.remove('active')
  authPopup.style.display = 'none'

  document.body.style.overflow = ''
}

// =========================== REGISTER POPUP ===========================

function openRegisterPopup () {
  document.getElementById('authPopup').classList.remove('active')
  document.getElementById('authPopup').style.display = 'none'

  document.getElementById('registerPopup').classList.add('active')
}

function closeRegisterPopup () {
  document.getElementById('registerPopup').classList.remove('active')

  document.body.style.overflow = ''
}

function backToLogin () {
  document.getElementById('registerPopup').classList.remove('active')

  document.getElementById('authPopup').style.display = 'flex'
  document.getElementById('authPopup').classList.add('active')
}

// =========================== OTP POPUP ===========================

function openOtpModal () {
  document.getElementById('registerPopup').classList.remove('active')

  document.getElementById('otpPopup').classList.add('active')
}

function closeOtpModal () {
  document.getElementById('otpPopup').classList.remove('active')

  document.body.style.overflow = ''
}

function verifyAccount () {
  document.getElementById('otpPopup').classList.remove('active')

  document.body.style.overflow = ''
}
