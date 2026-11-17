document.addEventListener('DOMContentLoaded', function () {
  const revealSections = document.querySelectorAll('[data-reveal]')

  if (
    !revealSections.length ||
    !('IntersectionObserver' in window) ||
    window.matchMedia('(prefers-reduced-motion: reduce)').matches
  ) {
    return
  }

  document.documentElement.classList.add('has-scroll-reveal')

  const revealObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible')
      } else {
        entry.target.classList.remove('is-visible')
      }
    })
  }, {
    threshold: 0.12
  })

  revealSections.forEach(function (section) {
    revealObserver.observe(section)
  })
})
document.addEventListener('DOMContentLoaded', function () {

  /* =====================================
     LIFE CARDS ANIMATION
     Each card reveals individually on scroll
  ===================================== */

  const lifeCards = document.querySelectorAll(
    '.jewelerp-life-section .life-card'
  )

  if (lifeCards.length) {
    const prefersReducedMotion = window.matchMedia(
      '(prefers-reduced-motion: reduce)'
    ).matches

    if (
      !('IntersectionObserver' in window) ||
      prefersReducedMotion
    ) {
      lifeCards.forEach(function (card) {
        card.classList.add('animate')
      })
    } else {
      const lifeObserver = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            const card = entry.target

            if (entry.isIntersecting) {
              card.classList.add('animate')
            } else {
              card.classList.remove('animate')
            }
          })
        },
        {
          threshold: 0.2,
          rootMargin: '0px 0px -50px 0px'
        }
      )

      lifeCards.forEach(function (card) {
        lifeObserver.observe(card)
      })
    }
  }

  /* =====================================
     FEATURE CARDS ANIMATION
     Staggered reveal on scroll
  ===================================== */

  const featureCards = document.querySelectorAll(
    '.feature-card:not(.feature-cta)'
  )

  const featuresSection = document.querySelector(
    '.features-section'
  )

  if (featuresSection && featureCards.length) {
    const prefersReducedMotion = window.matchMedia(
      '(prefers-reduced-motion: reduce)'
    ).matches

    if (
      !('IntersectionObserver' in window) ||
      prefersReducedMotion
    ) {
      featureCards.forEach(function (card) {
        card.classList.add('animate')
      })
    } else {
      const featureObserver = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              featureCards.forEach(function (card, index) {
                card.style.transitionDelay =
                  `${index * 100}ms`

                card.classList.add('animate')
              })
            } else {
              featureCards.forEach(function (card) {
                card.classList.remove('animate')
                card.style.transitionDelay = '0ms'
              })
            }
          })
        },
        {
          threshold: 0.2
        }
      )

      featureObserver.observe(featuresSection)
    }
  }

  /* =====================================
     PRICING CARDS ANIMATION
     Reveal on entry, reset on exit
  ===================================== */

  const pricingCards = document.querySelectorAll(
    '.jewel-pricing-card'
  )

  if (pricingCards.length) {
    const prefersReducedMotion = window.matchMedia(
      '(prefers-reduced-motion: reduce)'
    ).matches

    if (
      !('IntersectionObserver' in window) ||
      prefersReducedMotion
    ) {
      pricingCards.forEach(function (card) {
        card.classList.add('jewel-card-visible')
      })
    } else {
      const pricingObserver = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            const card = entry.target

            if (entry.isIntersecting) {
              const index = Array.from(pricingCards)
                .indexOf(card)

              card.style.transitionDelay =
                `${index * 180}ms`

              card.classList.add('jewel-card-visible')
            } else {
              card.classList.remove('jewel-card-visible')
              card.style.transitionDelay = '0ms'
            }
          })
        },
        {
          threshold: 0.15,
          rootMargin: '0px 0px -40px 0px'
        }
      )

      pricingCards.forEach(function (card) {
        pricingObserver.observe(card)
      })
    }
  }
})

document.addEventListener('DOMContentLoaded', function () {
  const topBar = document.querySelector('.jewel-top-bar')
  const navbar = document.querySelector('.jewel-navbar')

  if (!navbar) return

  let lastScrollY = window.scrollY

  window.addEventListener('scroll', function () {
    const currentScrollY = window.scrollY

    if (currentScrollY <= 10 || currentScrollY < lastScrollY) {
      // Scroll up: show both
      navbar.classList.remove('hide-on-scroll')

      if (topBar) {
        topBar.classList.remove('hide-on-scroll')
      }
    } else if (currentScrollY > lastScrollY) {
      // Scroll down: hide both
      navbar.classList.add('hide-on-scroll')

      if (topBar) {
        topBar.classList.add('hide-on-scroll')
      }
    }

    lastScrollY = currentScrollY
  }, { passive: true })
})

// -====================solution--------------========
/* =====================================================
   JEWEL ERP
   REVEAL ANIMATION
===================================================== */

document.addEventListener(
  'DOMContentLoaded',
  function () {

    /* ---------------------------------------------
       SELECT ALL REVEAL ELEMENTS
    --------------------------------------------- */

    const revealElements =
    document.querySelectorAll(
      '.reveal'
    )

    /* ---------------------------------------------
       INTERSECTION OBSERVER
    --------------------------------------------- */

    const revealObserver =
    new IntersectionObserver(

      function (entries, observer) {
        entries.forEach(
          function (entry) {

            /* -------------------------
               ELEMENT VISIBLE
            ------------------------- */

            if (
              entry.isIntersecting
            ) {
              entry.target.classList.add(
                'active'
              )

              /* -------------------------
                 STOP OBSERVING
              ------------------------- */

              observer.unobserve(
                entry.target
              )
            }
          }
        )
      },

      {
        threshold: 0.15
      }

    )

    /* ---------------------------------------------
       START OBSERVING
    --------------------------------------------- */

    revealElements.forEach(
      function (element) {
        revealObserver.observe(
          element
        )
      }
    )
  }
)

document.addEventListener(
  'DOMContentLoaded',
  function () {
    document.documentElement.classList.add(
      'jn-js'
    )

    const jnRevealElements =
    document.querySelectorAll(
      '.jn-reveal'
    )

    /* -----------------------------------------
       FALLBACK
    ----------------------------------------- */

    if (
      !(
      'IntersectionObserver'
      in window
      )
    ) {
      jnRevealElements.forEach(
        function (element) {
          element.classList.add(
            'jn-revealed'
          )
        }
      )

      return
    }

    /* -----------------------------------------
       OBSERVER
    ----------------------------------------- */

    const jnRevealObserver =
    new IntersectionObserver(

      function (
        entries,
        observer
      ) {
        entries.forEach(
          function (entry) {
            if (
              entry.isIntersecting
            ) {
              entry.target.classList.add(
                'jn-revealed'
              )

              observer.unobserve(
                entry.target
              )
            }
          }
        )
      },

      {
        threshold: 0.15,

        rootMargin: '0px 0px -60px 0px'

      }

    )

    /* -----------------------------------------
       START OBSERVING
    ----------------------------------------- */

    jnRevealElements.forEach(
      function (element) {
        jnRevealObserver.observe(
          element
        )
      }
    )
  }
)
document.addEventListener('DOMContentLoaded', function () {
  const revealItems = document.querySelectorAll('.jn-reveal-up')

  if (!('IntersectionObserver' in window)) {
    revealItems.forEach(function (item) {
      item.classList.add('jn-revealed')
    })
    return
  }

  document.documentElement.classList.add('jn-js')

  const revealObserver = new IntersectionObserver(function (entries, observer) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('jn-revealed')
        observer.unobserve(entry.target)
      }
    })
  }, { threshold: 0.15 })

  revealItems.forEach(function (item) {
    revealObserver.observe(item)
  })
})





/* =========================================================
   REVEAL ANIMATION
========================================================= */

document.addEventListener(
    "DOMContentLoaded",
    function () {


        const revealItems =
            document.querySelectorAll(
                ".jsai-reveal"
            );


        if (
            !("IntersectionObserver" in window)
        ) {

            revealItems.forEach(
                function (item) {

                    item.classList.add(
                        "jsai-visible"
                    );

                }
            );

        } else {

            const jsaiObserver =
                new IntersectionObserver(

                    function (
                        entries,
                        observer
                    ) {

                        entries.forEach(
                            function (entry) {

                                if (
                                    entry.isIntersecting
                                ) {

                                    entry.target.classList.add(
                                        "jsai-visible"
                                    );

                                    observer.unobserve(
                                        entry.target
                                    );

                                }

                            }
                        );

                    },

                    {
                        threshold: 0.12,

                        rootMargin:
                            "0px 0px -50px 0px"
                    }

                );


            revealItems.forEach(
                function (item) {

                    jsaiObserver.observe(item);

                }
            );

        }



        /* =================================================
           COPY PROMPT
        ================================================== */

        const copyButton =
            document.getElementById(
                "jsaiCopyBtn"
            );


        const copyText =
            document.getElementById(
                "jsaiCopyText"
            );


        const prompt =
            document.getElementById(
                "jsaiPromptText"
            );


        if (
            copyButton &&
            copyText &&
            prompt
        ) {

            copyButton.addEventListener(
                "click",
                async function () {

                    const text =
                        prompt.innerText.trim();


                    try {

                        await navigator.clipboard.writeText(
                            text
                        );


                        copyText.textContent =
                            "Copied!";


                        setTimeout(
                            function () {

                                copyText.textContent =
                                    "Copy prompt";

                            },
                            1800
                        );


                    } catch (error) {

                        const textarea =
                            document.createElement(
                                "textarea"
                            );


                        textarea.value =
                            text;

                        textarea.style.position =
                            "fixed";

                        textarea.style.opacity =
                            "0";


                        document.body.appendChild(
                            textarea
                        );


                        textarea.select();

                        document.execCommand(
                            "copy"
                        );


                        textarea.remove();


                        copyText.textContent =
                            "Copied!";


                        setTimeout(
                            function () {

                                copyText.textContent =
                                    "Copy prompt";

                            },
                            1800
                        );

                    }

                }
            );

        }

    }
);
