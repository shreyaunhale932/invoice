function toggleMenu () {
  const menu = document.getElementById('menu')
  const navRight = document.getElementById('navRight')

  menu.classList.toggle('navActive')
  navRight.classList.toggle('navActive')
}

// Smart Navbar - Hide on scroll down, show on scroll up
function toggleMenu () {
  const menu = document.getElementById('menu')
  const navRight = document.getElementById('navRight')

  menu.classList.toggle('navActive')
  navRight.classList.toggle('navActive')
}

// Smart Navbar - Hide on scroll down, show on scroll up
let lastScrollTop = 0;

const topBar = document.querySelector('.jewel-top-bar');
const navbar = document.querySelector('.jewel-navbar');

window.addEventListener('scroll', function () {
    const scrollTop =
        window.pageYOffset || document.documentElement.scrollTop;

    const mobileMenuOpen =
        document.querySelector('#menu.navActive') ||
        document.querySelector('#navRight.navActive') ||
        document.querySelector('.solutions-nav-item.menu-open');

    // Keep navbar visible while mobile menu is open
    if (window.innerWidth < 992 && mobileMenuOpen) {
        topBar?.classList.remove('hide-on-scroll');
        navbar?.classList.remove('hide-on-scroll');
        lastScrollTop = scrollTop;
        return;
    }

    if (scrollTop > lastScrollTop && scrollTop > 100) {
        topBar?.classList.add('hide-on-scroll');
        navbar?.classList.add('hide-on-scroll');
    } else {
        topBar?.classList.remove('hide-on-scroll');
        navbar?.classList.remove('hide-on-scroll');
    }

    lastScrollTop = scrollTop;
}, { passive: true });


// ====================navbar=pop-up===========

document.addEventListener('DOMContentLoaded', function () {
  const item = document.querySelector('.solutions-nav-item')
  const link = document.querySelector('.solutions-nav-link')
  const navRight = document.getElementById('navRight')
  const menu = document.getElementById('menu')

  navRight?.querySelectorAll('a[data-bs-toggle="modal"]').forEach(action => {
    action.addEventListener('click', function () {
      if (window.innerWidth <= 1024) {
        menu?.classList.remove('navActive')
        navRight.classList.remove('navActive')
      }
    })
  })

  if (!item || !link) return

  link.addEventListener('click', function (event) {
    if (window.innerWidth < 992) {
      event.preventDefault()

      const isOpen = item.classList.toggle('menu-open')
      link.setAttribute('aria-expanded', String(isOpen))
    }
  })

  window.addEventListener('resize', function () {
    if (window.innerWidth >= 992) {
      item.classList.remove('menu-open')
      link.setAttribute('aria-expanded', 'false')
    }
  })

  document.addEventListener('click', function (event) {
    if (!item.contains(event.target)) {
      item.classList.remove('menu-open')
      link.setAttribute('aria-expanded', 'false')
    }
  })
})

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

document.addEventListener('DOMContentLoaded', function () {
  const section = document.querySelector('.jewel-price-section')

  if (!section) return

  const toggleButtons = section.querySelectorAll(
    '.jewel-price-toggle-btn'
  )

  const planSets = section.querySelectorAll(
    '.jewel-price-plan-set'
  )

  section.querySelectorAll('.jewel-price-features-toggle')
    .forEach(function (button) {
      button.setAttribute('aria-expanded', 'false')

      button.addEventListener('click', function () {
        const card = button.closest('.jewel-price-card')

        const expanded = card.classList.toggle(
          'jewel-price-expanded'
        )

        card.querySelectorAll('.jewel-price-features-toggle')
          .forEach(function (control) {
            control.setAttribute(
              'aria-expanded',
              expanded ? 'true' : 'false'
            )

            if (control.classList.contains('jewel-price-features-arrow')) {
              control.setAttribute(
                'aria-label',
                expanded ? 'Hide additional features' : 'Show additional features'
              )
            }

            const icon = control.querySelector('i')

            if (icon) {
              icon.classList.toggle('bi-chevron-down', !expanded)
              icon.classList.toggle('bi-chevron-up', expanded)
            }
          })
      })
    })})
    // ==============pricing====================

document.addEventListener('DOMContentLoaded', function () {
  const pricingSection = document.querySelector('.jewel-pricing-section')

  if (!pricingSection) return

  // Toggle buttons
  const toggleButtons = pricingSection.querySelectorAll(
    '.jewel-pricing-toggle-btn'
  )

  const priceValues = pricingSection.querySelectorAll(
    '.jewel-pricing-price-value'
  )

  const oldPrices = pricingSection.querySelectorAll(
    '.jewel-pricing-old-price del'
  )

  const billingLabels = pricingSection.querySelectorAll(
    '.jewel-pricing-billing'
  )

  const periodLabels = pricingSection.querySelectorAll(
    '.jewel-pricing-period'
  )

  const discountBadges = pricingSection.querySelectorAll(
    '.jewel-pricing-discount'
  )

  const yearlyDiscounts = ['50% OFF', 'SAVE 33%', '50% OFF']

  // Monthly / Yearly pricing update
  function updatePricing (period) {
    // Active button
    toggleButtons.forEach(function (button) {
      const isActive = button.dataset.period === period

      button.classList.toggle('active', isActive)
      button.setAttribute(
        'aria-pressed',
        isActive ? 'true' : 'false'
      )
    })

    // Update prices
    priceValues.forEach(function (price) {
      const value = price.dataset[period]

      if (value !== undefined) {
        price.textContent = value
      }
    })

    // Update old prices, if present
    oldPrices.forEach(function (price) {
      const value = price.dataset[period]

      if (value !== undefined) {
        price.textContent = value
      }
    })

    // Billing text
    billingLabels.forEach(function (label) {
      label.textContent = period === 'monthly'
        ? 'Billed monthly'
        : 'Billed annually'
    })

    // Price period: / month or / year
    periodLabels.forEach(function (label) {
      const value = label.dataset[period]

      if (value !== undefined) {
        label.textContent = value
      }
    })

    // Discount badges
    discountBadges.forEach(function (badge, index) {
      if (period === 'yearly') {
        badge.textContent = yearlyDiscounts[index] || ''
        badge.style.visibility = 'visible'
      } else {
        badge.textContent = ''
        badge.style.visibility = 'hidden'
      }
    })
  }

  // Add toggle events
  toggleButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      const period = this.dataset.period

      if (period === 'monthly' || period === 'yearly') {
        updatePricing(period)
      }
    })
  })

  // IMPORTANT: Monthly is active on initial page load
  updatePricing('monthly')

  // =====================================
  // PRICING CARD SELECTION
  // =====================================

  const pricingCards = pricingSection.querySelectorAll(
    '.jewel-pricing-card'
  )

  pricingCards.forEach(function (card) {
    card.addEventListener('click', function (event) {
      // Do not change card selection when clicking CTA links
      if (event.target.closest('a, button')) return

      // Reset all cards
      pricingCards.forEach(function (item) {
        item.classList.remove('jewel-pricing-card-featured')

        const badge = item.querySelector(
          '.jewel-pricing-popular'
        )

        if (badge) badge.remove()

        const button = item.querySelector('.jewel-pricing-cta')

        if (button) {
          button.classList.remove('jewel-pricing-cta-primary')
          button.classList.add('jewel-pricing-cta-outline')
        }
      })

      // Set selected card
      card.classList.add('jewel-pricing-card-featured')

      const header = card.querySelector(
        '.jewel-pricing-card-header'
      )

      if (header) {
        const badge = document.createElement('div')
        badge.className = 'jewel-pricing-popular'

        const index = Array.from(pricingCards).indexOf(card)

        badge.textContent = [
            'BASIC',
            'MOST POPULAR',
            'PREMIUM'
          ][index] || ''

        card.insertBefore(badge, header)
      }

      const activeButton = card.querySelector('.jewel-pricing-cta')

      if (activeButton) {
        activeButton.classList.remove('jewel-pricing-cta-outline')
        activeButton.classList.add('jewel-pricing-cta-primary')
      }
    })
  })

  // =====================================
  // PRICING CARD REVEAL ANIMATION
  // =====================================

  if (!('IntersectionObserver' in window) ||
    window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    pricingCards.forEach(function (card) {
      card.classList.add('jewel-card-visible')
    })
    return
  }

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        const card = entry.target
        const index = Array.from(pricingCards).indexOf(card)

        card.style.transitionDelay = (index * 180) + 'ms'
        card.classList.add('jewel-card-visible')

        observer.unobserve(card)
      }
    })
  }, {
    threshold: 0.15,
    rootMargin: '0px 0px -40px 0px'
  })

  pricingCards.forEach(function (card) {
    observer.observe(card)
  })
})

/* =========== FAQ SLOW REVEAL ANIMATION =========== */

document.addEventListener('DOMContentLoaded', function () {
  const faqSection = document.querySelector('.jewel-faq-section')

  if (!faqSection) return

  const elements = faqSection.querySelectorAll(
    '.jewel-faq-title, ' +
    '.jewel-faq-item, ' +
    '.jewel-faq-contact-card, ' +
    '.jewel-faq-read-more'
  )

  if (
    window.matchMedia('(prefers-reduced-motion: reduce)').matches ||
    !('IntersectionObserver' in window)
  ) {
    elements.forEach(element => {
      element.classList.add('jewel-faq-revealed')
    })
    return
  }

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('jewel-faq-revealed')
      } else {
        entry.target.classList.remove('jewel-faq-revealed')
      }
    })
  }, {
    threshold: 0.02,
    rootMargin: '0px 0px 0px 0px'
  })

  elements.forEach(function (element, index) {
    element.style.transitionDelay = `${index * 250}ms`
    observer.observe(element)
  })
})

/* =========== TEAM CONTACT SECTION ANIMATION =========== */

document.addEventListener('DOMContentLoaded', function () {
  const revealElements = document.querySelectorAll('[data-reveal]')

  if (!revealElements.length) return

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate')
        observer.unobserve(entry.target)
      }
    })
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  })

  revealElements.forEach(function (element) {
    observer.observe(element)
  })
})









document.addEventListener("DOMContentLoaded", function () {

    // =====================================
    // COPY PROMPT
    // =====================================

    const copyBtn = document.getElementById("copyJewelPrompt");
    const promptText = document.getElementById("jewelAiPrompt");
    const feedback = document.getElementById("jewelCopyFeedback");

    if (copyBtn && promptText) {

        copyBtn.addEventListener("click", async function () {

            const text = promptText.innerText.trim();

            try {

                await navigator.clipboard.writeText(text);

                copyBtn.innerHTML =
                    '<i class="bi bi-check2"></i><span>Copied!</span>';

                if (feedback) {
                    feedback.textContent = "Prompt copied successfully!";
                }

            } catch (error) {

                const textarea = document.createElement("textarea");
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();

                const copied = document.execCommand("copy");
                textarea.remove();

                if (copied) {
                    copyBtn.innerHTML =
                        '<i class="bi bi-check2"></i><span>Copied!</span>';

                    if (feedback) {
                        feedback.textContent = "Prompt copied successfully!";
                    }
                }

            }

            setTimeout(function () {

                copyBtn.innerHTML =
                    '<i class="bi bi-copy"></i><span>Copy prompt</span>';

                if (feedback) feedback.textContent = "";

            }, 2500);

        });

    }

// =============chatboat=============== //
/* =========================================================
   JEWELERP CHATBOT - FRONTEND ONLY
========================================================= */

(function () {

    "use strict";


    /* =====================================================
       INITIALIZE
    ====================================================== */

    function initJewelERPChat() {

        const openButton = document.getElementById("jewelOpenChat");
        const closeButton = document.getElementById("jewelCloseChat");
        const chatBox = document.getElementById("jewelChatBox");
        const overlay = document.getElementById("jewelChatOverlay");
        const chatBody = document.getElementById("jewelChatBody");
        const chatInput = document.getElementById("jewelChatInput");
        const sendButton = document.getElementById("jewelSendChat");
        const backTop = document.getElementById("jewelBackTop");


        /* =================================================
           CHECK REQUIRED ELEMENTS
        ================================================== */

        if (
            !openButton ||
            !closeButton ||
            !chatBox ||
            !chatBody ||
            !chatInput ||
            !sendButton
        ) {

            console.warn(
                "JewelERP Chatbot: Required HTML elements are missing."
            );

            return;
        }


        /* =================================================
           OPEN CHAT
        ================================================== */

        function openChat() {

            chatBox.classList.add("active");

            if (overlay) {
                overlay.classList.add("active");
            }

            chatBox.setAttribute(
                "aria-hidden",
                "false"
            );

            document.body.classList.add(
                "jewel-chat-opened"
            );

            setTimeout(function () {

                chatInput.focus();

                scrollChat();

            }, 250);
        }


        /* =================================================
           CLOSE CHAT
        ================================================== */

        function closeChat() {

            chatBox.classList.remove("active");

            if (overlay) {
                overlay.classList.remove("active");
            }

            chatBox.setAttribute(
                "aria-hidden",
                "true"
            );

            document.body.classList.remove(
                "jewel-chat-opened"
            );
        }


        /* =================================================
           OPEN BUTTON
        ================================================== */

        openButton.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                if (
                    chatBox.classList.contains("active")
                ) {

                    closeChat();

                } else {

                    openChat();

                }

            }
        );


        /* =================================================
           CLOSE BUTTON
        ================================================== */

        closeButton.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                closeChat();

            }
        );


        /* =================================================
           OVERLAY
        ================================================== */

        if (overlay) {

            overlay.addEventListener(
                "click",
                function () {

                    closeChat();

                }
            );

        }


        /* =================================================
           ESCAPE KEY
        ================================================== */

        document.addEventListener(
            "keydown",
            function (event) {

                if (
                    event.key === "Escape" &&
                    chatBox.classList.contains("active")
                ) {

                    closeChat();

                }

            }
        );


        /* =================================================
           SEND MESSAGE
        ================================================== */

        function sendMessage() {

            const message =
                chatInput.value.trim();


            if (!message) {

                return;

            }


            /* =============================================
               USER MESSAGE
            ============================================== */

            const userMessage =
                document.createElement("div");


            userMessage.className =
                "jewel-chat-message jewel-user-message";


            const userContent =
                document.createElement("div");


            userContent.className =
                "jewel-message-content";


            const userText =
                document.createElement("p");


            userText.textContent =
                message;


            userContent.appendChild(
                userText
            );


            userMessage.appendChild(
                userContent
            );


            chatBody.appendChild(
                userMessage
            );


            /* =============================================
               CLEAR INPUT
            ============================================== */

            chatInput.value = "";


            scrollChat();


            /* =============================================
               TYPING
            ============================================== */

            showTyping();


            /* =============================================
               FRONTEND DEMO RESPONSE
            ============================================== */

            setTimeout(
                function () {

                    removeTyping();


                    addBotMessage(
                        getBotReply(message)
                    );

                },
                900
            );

        }


        /* =================================================
           SEND BUTTON
        ================================================== */

        sendButton.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                sendMessage();

            }
        );


        /* =================================================
           ENTER KEY
        ================================================== */

        chatInput.addEventListener(
            "keydown",
            function (event) {

                if (
                    event.key === "Enter" &&
                    !event.shiftKey
                ) {

                    event.preventDefault();

                    sendMessage();

                }

            }
        );


        /* =================================================
           FRONTEND BOT REPLIES
        ================================================== */

        function getBotReply(message) {

            const text =
                message.toLowerCase();


            if (
                text.includes("service") ||
                text.includes("services")
            ) {

                return "JewelERP provides jewellery business solutions including inventory management, billing, customer management, reporting and business operations.";

            }


            if (
                text.includes("price") ||
                text.includes("pricing") ||
                text.includes("cost")
            ) {

                return "For JewelERP pricing and plans, please contact our team. They will provide the most suitable plan for your jewellery business.";

            }


            if (
                text.includes("contact") ||
                text.includes("team")
            ) {

                return "Our support team can help you with JewelERP, demos, pricing and business requirements. Please use the Contact Team option.";

            }


            if (
                text.includes("inventory") ||
                text.includes("stock")
            ) {

                return "JewelERP helps you manage jewellery inventory, stock movement, item details, weight, purity and business records.";

            }


            if (
                text.includes("billing") ||
                text.includes("invoice")
            ) {

                return "JewelERP supports jewellery billing workflows with structured calculations and business records.";

            }


            if (
                text.includes("about") ||
                text.includes("jewelERP") ||
                text.includes("jewelerp")
            ) {

                return "JewelERP is an integrated jewellery ERP solution designed to simplify inventory, billing, customer management and reporting.";

            }


            return "Thank you for your question! I can help with JewelERP features, pricing, inventory, billing and demo information. For detailed assistance, please contact our team.";

        }


        /* =================================================
           ADD BOT MESSAGE
        ================================================== */

        function addBotMessage(message) {

            const wrapper =
                document.createElement("div");


            wrapper.className =
                "jewel-chat-message";


            const icon =
                document.createElement("div");


            icon.className =
                "jewel-message-icon";


            icon.innerHTML =
                '<i class="fa-solid fa-robot"></i>';


            const content =
                document.createElement("div");


            content.className =
                "jewel-message-content";


            const text =
                document.createElement("p");


            text.textContent =
                message;


            content.appendChild(
                text
            );


            wrapper.appendChild(
                icon
            );


            wrapper.appendChild(
                content
            );


            chatBody.appendChild(
                wrapper
            );


            scrollChat();

        }


        /* =================================================
           SHOW TYPING
        ================================================== */

        function showTyping() {

            removeTyping();


            const wrapper =
                document.createElement("div");


            wrapper.className =
                "jewel-chat-message";


            wrapper.id =
                "jewelTyping";


            const icon =
                document.createElement("div");


            icon.className =
                "jewel-message-icon";


            icon.innerHTML =
                '<i class="fa-solid fa-robot"></i>';


            const content =
                document.createElement("div");


            content.className =
                "jewel-message-content";


            content.innerHTML = `
                <div class="jewel-typing">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            `;


            wrapper.appendChild(
                icon
            );


            wrapper.appendChild(
                content
            );


            chatBody.appendChild(
                wrapper
            );


            scrollChat();

        }


        /* =================================================
           REMOVE TYPING
        ================================================== */

        function removeTyping() {

            const typing =
                document.getElementById(
                    "jewelTyping"
                );


            if (typing) {

                typing.remove();

            }

        }


        /* =================================================
           QUICK BUTTONS
        ================================================== */

        const quickButtons =
            document.querySelectorAll(
                "[data-question]"
            );


        quickButtons.forEach(
            function (button) {

                button.addEventListener(
                    "click",
                    function (event) {

                        event.preventDefault();

                        const question =
                            this.getAttribute(
                                "data-question"
                            );


                        if (!question) {
                            return;
                        }


                        chatInput.value =
                            question;


                        sendMessage();

                    }
                );

            }
        );


        /* =================================================
           AUTO SCROLL
        ================================================== */

        function scrollChat() {

            setTimeout(
                function () {

                    chatBody.scrollTo({

                        top:
                            chatBody.scrollHeight,

                        behavior:
                            "smooth"

                    });

                },
                50
            );

        }


        /* =================================================
           BACK TO TOP
        ================================================== */

        if (backTop) {

            backTop.addEventListener(
                "click",
                function (event) {

                    event.preventDefault();

                    window.scrollTo({

                        top: 0,

                        behavior: "smooth"

                    });

                }
            );

        }


        /* =================================================
           INITIAL STATE
        ================================================== */

        chatBox.classList.remove(
            "active"
        );


        if (overlay) {

            overlay.classList.remove(
                "active"
            );

        }


        chatBox.setAttribute(
            "aria-hidden",
            "true"
        );


        console.log(
            "JewelERP Chatbot initialized successfully."
        );

    }


    /* =====================================================
       DOM READY
    ====================================================== */

    if (
        document.readyState === "loading"
    ) {

        document.addEventListener(
            "DOMContentLoaded",
            initJewelERPChat
        );

    } else {

        initJewelERPChat();

    }

})();


// ============chatboat end============ //


    // =====================================
    // TALK TO OUR TEAM BUTTON
    // =====================================

    if (teamBtn) {

        teamBtn.addEventListener("click", function (e) {

            e.preventDefault();
            openJewelChatbot();

        });

    }


    // =====================================
    // FLOATING CHAT ICON
    // =====================================

    if (toggleBtn) {

        toggleBtn.addEventListener("click", function () {

            if (chatWindow && chatWindow.classList.contains("active")) {
                closeJewelChatbot();
            } else {
                openJewelChatbot();
            }

        });

    }


    // =====================================
    // CLOSE ICON
    // =====================================

    if (closeBtn) {
        closeBtn.addEventListener("click", closeJewelChatbot);
    }


    // =====================================
    // SEND MESSAGE
    // =====================================

    const chatForm = document.getElementById("jewelChatForm");
    const chatBody = document.getElementById("jewelChatBody");

    if (chatForm && chatBody && chatInput) {

        chatForm.addEventListener("submit", function (e) {

            e.preventDefault();

            const message = chatInput.value.trim();

            if (!message) return;

            const userMessage = document.createElement("div");
            userMessage.className = "jewel-chat-message user-message";

            const userBubble = document.createElement("div");
            userBubble.className = "jewel-message-bubble";
            userBubble.textContent = message;

            userMessage.appendChild(userBubble);
            chatBody.appendChild(userMessage);

            chatInput.value = "";

            chatBody.scrollTop = chatBody.scrollHeight;

            setTimeout(function () {

                const botMessage = document.createElement("div");
                botMessage.className = "jewel-chat-message bot-message";

                const botBubble = document.createElement("div");
                botBubble.className = "jewel-message-bubble";

                botBubble.textContent =
                    "Thank you for contacting JewelERP! Our team can help you with your jewellery business requirements, features and demo enquiries.";

                botMessage.appendChild(botBubble);
                chatBody.appendChild(botMessage);

                chatBody.scrollTop = chatBody.scrollHeight;

            }, 700);

        });

    }

});




// =============videos===================
/* =========================================================
   PREMIUM VIDEO SYSTEM
========================================================= */

(function () {

    const jxvCards =
        document.querySelectorAll(".jxv-card");

    const jxvTabs =
        document.querySelectorAll(".jxv-tab");

    const jxvModal =
        document.getElementById("jxvModal");

    const jxvYoutube =
        document.getElementById("jxvYoutube");

    const jxvClose =
        document.getElementById("jxvClose");


    /* =====================================================
       OPEN VIDEO
    ===================================================== */

    jxvCards.forEach(function (card) {

        card.addEventListener(
            "click",
            function () {

                const videoId =
                    card.getAttribute(
                        "data-video"
                    );

                if (!videoId) {
                    return;
                }


                jxvYoutube.src =
                    "https://www.youtube.com/embed/" +
                    videoId +
                    "?autoplay=1&rel=0";


                jxvModal.classList.add(
                    "jxv-open"
                );


                document.body.style.overflow =
                    "hidden";

            }
        );

    });


    /* =====================================================
       CLOSE VIDEO
    ===================================================== */

    function jxvCloseVideo() {

        jxvModal.classList.remove(
            "jxv-open"
        );

        jxvYoutube.src = "";

        document.body.style.overflow =
            "";

    }


    jxvClose.addEventListener(
        "click",
        jxvCloseVideo
    );


    /* =====================================================
       BACKDROP CLOSE
    ===================================================== */

    jxvModal.addEventListener(
        "click",
        function (event) {

            if (
                event.target === jxvModal
            ) {

                jxvCloseVideo();

            }

        }
    );


    /* =====================================================
       ESC CLOSE
    ===================================================== */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                jxvModal.classList.contains(
                    "jxv-open"
                )
            ) {

                jxvCloseVideo();

            }

        }
    );


    /* =====================================================
       CATEGORY FILTER
    ===================================================== */

    jxvTabs.forEach(function (tab) {

        tab.addEventListener(
            "click",
            function () {

                jxvTabs.forEach(
                    function (item) {

                        item.classList.remove(
                            "jxv-active"
                        );

                    }
                );


                tab.classList.add(
                    "jxv-active"
                );


                const category =
                    tab.getAttribute(
                        "data-category"
                    );


                jxvCards.forEach(
                    function (card) {

                        const cardCategory =
                            card.getAttribute(
                                "data-category"
                            );


                        if (
                            cardCategory === category
                        ) {

                            card.classList.remove(
                                "jxv-hidden"
                            );

                        } else {

                            card.classList.add(
                                "jxv-hidden"
                            );

                        }

                    }
                );

            }
        );

    });

})();




// =============sign-up and forget password otp =========== //


/* =========================================================
   COMMON OTP
   SIGNUP + FORGOT PASSWORD
========================================================= */

function jewelMoveOtp(input) {

    /* Only numbers */
    input.value = input.value.replace(/[^0-9]/g, '');


    /* Find the OTP group containing this input */
    const group = input.closest(
        '.jewel-signup-otp, .jewel-forgot-otp'
    );

    if (!group) {
        return;
    }


    /* Get only inputs from current OTP group */
    const inputs = Array.from(
        group.querySelectorAll('.jewel-common-otp')
    );


    /* Current input position */
    const currentIndex =
        inputs.indexOf(input);


    /* =========================================
       MOVE TO NEXT BOX
    ========================================= */

    if (
        input.value.length === 1 &&
        currentIndex >= 0 &&
        currentIndex < inputs.length - 1
    ) {

        inputs[currentIndex + 1].focus();

        inputs[currentIndex + 1].select();

    }

}


/* =========================================================
   BACKSPACE
========================================================= */

function jewelOtpBackspace(event, input) {

    if (event.key !== 'Backspace') {
        return;
    }


    const group = input.closest(
        '.jewel-signup-otp, .jewel-forgot-otp'
    );

    if (!group) {
        return;
    }


    const inputs = Array.from(
        group.querySelectorAll('.jewel-common-otp')
    );


    const currentIndex =
        inputs.indexOf(input);


    /* =========================================
       CURRENT BOX HAS VALUE
    ========================================= */

    if (input.value !== '') {

        input.value = '';

        event.preventDefault();

        return;

    }


    /* =========================================
       CURRENT BOX EMPTY
       MOVE TO PREVIOUS
    ========================================= */

    if (currentIndex > 0) {

        event.preventDefault();

        inputs[currentIndex - 1].focus();

        inputs[currentIndex - 1].select();

    }

}


/* =========================================================
   PASTE OTP
========================================================= */

document.addEventListener(
    'paste',
    function(event) {

        const input = event.target;


        if (
            !input.classList.contains(
                'jewel-common-otp'
            )
        ) {
            return;
        }


        const group = input.closest(
            '.jewel-signup-otp, .jewel-forgot-otp'
        );

        if (!group) {
            return;
        }


        const inputs = Array.from(
            group.querySelectorAll(
                '.jewel-common-otp'
            )
        );


        const pasted =
            event.clipboardData
                .getData('text')
                .replace(/[^0-9]/g, '')
                .slice(0, inputs.length);


        if (!pasted) {
            return;
        }


        event.preventDefault();


        pasted.split('').forEach(
            function(digit, index) {

                if (inputs[index]) {

                    inputs[index].value = digit;

                }

            }
        );


        /* Focus last entered box */

        const lastIndex =
            Math.min(
                pasted.length,
                inputs.length
            ) - 1;


        if (lastIndex >= 0) {

            inputs[lastIndex].focus();

        }

    }
);
