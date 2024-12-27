HTMLElement.prototype.$A = function (name) {
  return this.getAttribute(name);
};

HTMLElement.prototype.$ = function (q) {
  return this.querySelector(q);
};

HTMLElement.prototype.$$ = function (q) {
  return this.querySelectorAll(q);
};

function $mkComp(name, cons = () => {}) {
  if (!name) {
    throw new Error("Component name is required");
  }

  name = `c-${name}`;

  if (!customElements.get(name)) {
    customElements.define(
      name,
      class T extends HTMLElement {
        constructor() {
          super();
        }
        connectedCallback() {
          try {
            cons(this);
            this.$new = (content, f) => {
              this.innerHTML = content;
              f(this);
            };
          } catch (error) {
            console.error(`Error in component ${name}:`, error);
          }
        }
      }
    );
  }
}
