window.addEventListener("load", () => {

    function unActiveMenuItem(target) {
        if (target == "all") {
            menuItem.forEach((element) => {
                element.classList.remove("active");
            });
        }
    }

    function unActiveMenuTitle(target) {
        if (target == "all") {
            menuTitles.forEach((element) => {
                element.classList.remove("activeTitleMenu");
            });
        } else {
            target.classList.remove("activeTitleMenu");
        }
    }

    EnlighterJS.init('pre', 'code');

    const menuItem = document.querySelectorAll(".menu ul li");
    const codeBlocks = document.querySelectorAll(".codeBlock");
    const menuTitles = document.querySelectorAll(".menu ul div.menuSubTitle");
    const globalParagraphe = document.getElementById("globalParagraphe");

    globalParagraphe.addEventListener("click", () => {
        menuItem[3].click();
    })

    menuItem.forEach((list) => {
        list.addEventListener("click", () => {
            // Unactive all element before procedd
            unActiveMenuItem("all");

            // hide All element
            codeBlocks.forEach((codeBlock) => {
                codeBlock.classList.replace("visible", "invisible");
            })

            // Active target menu
            list.classList.add("active");
            // load target Data;
            let el = document.querySelector(".codeBlock[data-globals='" + list.dataset.targetGlobal + "']");
            el.classList.replace("invisible", "visible");
        })
    });

    menuTitles.forEach((menuTitle) => {
        menuTitle.addEventListener("click", () => {
            unActiveMenuTitle("all");
            menuTitle.classList.add("activeTitleMenu");
        })
    })
})