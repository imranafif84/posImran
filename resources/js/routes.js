
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;

let home = require('./components/home.vue').default;

let allEmployee = require('./components/employees/index.vue').default;
let createEmployee = require('./components/employees/create.vue').default;
let editEmployee = require('./components/employees/edit.vue').default;

let allSupplier = require('./components/suppliers/index.vue').default;
let createSupplier = require('./components/suppliers/create.vue').default;
let editSupplier = require('./components/suppliers/edit.vue').default;

let allCategory = require('./components/categories/index.vue').default;
let createCategory = require('./components/categories/create.vue').default;
let editCategory = require('./components/categories/edit.vue').default;

let allProduct = require('./components/products/index.vue').default;
let createProduct = require('./components/products/create.vue').default;
let editProduct = require('./components/products/edit.vue').default;

let allExpense = require('./components/expenses/index.vue').default;
let createExpense = require('./components/expenses/create.vue').default;
let editExpense = require('./components/expenses/edit.vue').default;

let allEmpSalary = require('./components/salaries/all_employee.vue').default;
let allSalary = require('./components/salaries/index.vue').default;
let paySalary = require('./components/salaries/create.vue').default;
let viewSalary = require('./components/salaries/view.vue').default;
let editSalary = require('./components/salaries/edit.vue').default;

let allStock = require('./components/products/stock.vue').default;
let editStock = require('./components/products/editstock.vue').default;

let allCustomer = require('./components/customers/index.vue').default;
let createCustomer = require('./components/customers/create.vue').default;
let editCustomer = require('./components/customers/edit.vue').default;

let pos = require('./components/pos/pointofsale.vue').default;

let todayOrder = require('./components/orders/todayOrder.vue').default;
let viewOrder = require('./components/orders/viewOrder.vue').default;
let searchOrder = require('./components/orders/searchOrder.vue').default;

export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forget', component: forget, name: 'forget' },
    { path: '/logout', component: logout, name: 'logout' },
    { path: '/home', component: home, name: 'home' },
    { path: '/allEmployee', component: allEmployee, name: 'allEmployee' },
    { path: '/createEmployee', component: createEmployee, name: 'createEmployee' },
    { path: '/editEmployee/:id', component: editEmployee, name: 'editEmployee' },
    { path: '/allSupplier', component: allSupplier, name: 'allSupplier' },
    { path: '/createSupplier', component: createSupplier, name: 'createSupplier' },
    { path: '/editSupplier/:id', component: editSupplier, name: 'editSupplier' },
    { path: '/allCategory', component: allCategory, name: 'allCategory' },
    { path: '/createCategory', component: createCategory, name: 'createCategory' },
    { path: '/editCategory/:id', component: editCategory, name: 'editCategory' },
    { path: '/allProduct', component: allProduct, name: 'allProduct' },
    { path: '/createProduct', component: createProduct, name: 'createProduct' },
    { path: '/editProduct/:id', component: editProduct, name: 'editProduct' },
    { path: '/allExpense', component: allExpense, name: 'allExpense' },
    { path: '/createExpense', component: createExpense, name: 'createExpense' },
    { path: '/editExpense/:id', component: editExpense, name: 'editExpense' },
    { path: '/allEmpSalary', component: allEmpSalary, name: 'allEmpSalary' },
    { path: '/paySalary', component: paySalary, name: 'paySalary' },
    { path: '/allSalary', component: allSalary, name: 'allSalary' },
    { path: '/viewSalary/:id', component: viewSalary, name: 'viewSalary' },
    { path: '/editSalary/:id', component: editSalary, name: 'editSalary' },
    { path: '/allStock', component: allStock, name: 'allStock' },
    { path: '/editStock/:id', component: editStock, name: 'editStock' },
    { path: '/allCustomer', component: allCustomer, name: 'allCustomer' },
    { path: '/createCustomer', component: createCustomer, name: 'createCustomer' },
    { path: '/editCustomer/:id', component: editCustomer, name: 'editCustomer' },
    { path: '/pos', component: pos, name: 'pos' },
    { path: '/todayOrder', component: todayOrder, name: 'todayOrder' },
    { path: '/viewOrder/:id', component: viewOrder, name: 'viewOrder' },
    { path: '/searchOrder', component: searchOrder, name: 'searchOrder' }

  ]