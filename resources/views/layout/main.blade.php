<!DOCTYPE html>
<html lang="en" class="dark" data-theme="luxury">

@extends('layout.head')

<body>
    <div class="navbar bg-neutral">
        <div class="navbar-start">
            <div class="drawer">
                <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    <label role="button" for="my-drawer" class="btn btn-ghost btn-circle drawer-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </label>
                </div>
                <div class="drawer-side z-50">
                    <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay w-auto"></label>
                    <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
                        <!-- Sidebar content here -->
                        <div class="flex justify-between mb-10 pr-3 sm:px-2"><button
                                class="lg:hidden text-indigo-500 hover:text-indigo-400" aria-controls="sidebar"
                                aria-expanded="false"><span class="sr-only">Close sidebar</span><svg
                                    class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z"></path>
                                </svg></button><a aria-current="page" class="block active" href="/"><svg
                                    width="32" height="32" viewBox="0 0 32 32">
                                    <defs>
                                        <linearGradient x1="28.538%" y1="20.229%" x2="100%" y2="108.156%"
                                            id="logo-a">
                                            <stop stop-color="#A5B4FC" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#A5B4FC" offset="100%"></stop>
                                        </linearGradient>
                                        <linearGradient x1="88.638%" y1="29.267%" x2="22.42%" y2="100%"
                                            id="logo-b">
                                            <stop stop-color="#38BDF8" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#38BDF8" offset="100%"></stop>
                                        </linearGradient>
                                    </defs>
                                    <rect fill="#6366F1" width="32" height="32" rx="16"></rect>
                                    <path
                                        d="M18.277.16C26.035 1.267 32 7.938 32 16c0 8.837-7.163 16-16 16a15.937 15.937 0 01-10.426-3.863L18.277.161z"
                                        fill="#4F46E5"></path>
                                    <path
                                        d="M7.404 2.503l18.339 26.19A15.93 15.93 0 0116 32C7.163 32 0 24.837 0 16 0 10.327 2.952 5.344 7.404 2.503z"
                                        fill="url(#logo-a)"></path>
                                    <path
                                        d="M2.223 24.14L29.777 7.86A15.926 15.926 0 0132 16c0 8.837-7.163 16-16 16-5.864 0-10.991-3.154-13.777-7.86z"
                                        fill="url(#logo-b)"></path>
                                </svg></a></div>
                        {{-- @if if(auth()->user()->hasRole(['admin'])) --}}
                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
                            <li><a href="/dashboard">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-indigo-500"
                                                    d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z">
                                                </path>
                                                <path class="fill-current text-accent"
                                                    d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z">
                                                </path>
                                                <path class="fill-current text-indigo-200"
                                                    d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                                        </div>
                                    </div>
                                </a></li>
                            <div class="divider">Master Data</div>
                            <li><a href="/users">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-indigo-400"
                                                    d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z"></path>
                                                <path class="fill-current text-indigo-700"
                                                    d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z"></path>
                                                <path class="fill-current text-accent"
                                                    d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manajemen User</span>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a href="/product">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-indigo-400"
                                                    d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z"></path>
                                                <path class="fill-current text-indigo-700"
                                                    d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z"></path>
                                                <path class="fill-current text-accent"
                                                    d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Product</span>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a href="/customer">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-accent"
                                                    d="M18.974 8H22a2 2 0 012 2v6h-2v5a1 1 0 01-1 1h-2a1 1 0 01-1-1v-5h-2v-6a2 2 0 012-2h.974zM20 7a2 2 0 11-.001-3.999A2 2 0 0120 7zM2.974 8H6a2 2 0 012 2v6H6v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5H0v-6a2 2 0 012-2h.974zM4 7a2 2 0 11-.001-3.999A2 2 0 014 7z">
                                                </path>
                                                <path class="fill-current text-indigo-400"
                                                    d="M12 6a3 3 0 110-6 3 3 0 010 6zm2 18h-4a1 1 0 01-1-1v-6H6v-6a3 3 0 013-3h6a3 3 0 013 3v6h-3v6a1 1 0 01-1 1z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer</span>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a href="/supplier">
                                    <div class="flex items-center"><svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                            <path class="fill-current text-accent" d="M16 13v4H8v-4H0l3-9h18l3 9h-8Z">
                                            </path>
                                            <path class="fill-current text-indigo-400"
                                                d="m23.72 12 .229.686A.984.984 0 0 1 24 13v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-8c0-.107.017-.213.051-.314L.28 12H8v4h8v-4H23.72ZM13 0v7h3l-4 5-4-5h3V0h2Z">
                                            </path>
                                        </svg><span
                                            class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Supplier</span>
                                    </div>
                                </a></li>
                            <div class="divider">Transaction</div>
                            <!-- <li><a href="/finance">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-indigo-400"
                                                    d="M13 6.068a6.035 6.035 0 0 1 4.932 4.933H24c-.486-5.846-5.154-10.515-11-11v6.067Z">
                                                </path>
                                                <path class="fill-current text-indigo-700"
                                                    d="M18.007 13c-.474 2.833-2.919 5-5.864 5a5.888 5.888 0 0 1-3.694-1.304L4 20.731C6.131 22.752 8.992 24 12.143 24c6.232 0 11.35-4.851 11.857-11h-5.993Z">
                                                </path>
                                                <path class="fill-current text-accent"
                                                    d="M6.939 15.007A5.861 5.861 0 0 1 6 11.829c0-2.937 2.167-5.376 5-5.85V0C4.85.507 0 5.614 0 11.83c0 2.695.922 5.174 2.456 7.17l4.483-3.993Z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Finance</span>
                                        </div>

                                    </div>
                                </a></li> -->
                            <li><a href="/incoming">
                                    <div class="flex items-center"><svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                            <path class="fill-current text-accent" d="M1 3h22v20H1z"></path>
                                            <path class="fill-current text-indigo-400"
                                                d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z">
                                            </path>
                                        </svg><span
                                            class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Incomming
                                            Product
                                        </span>
                                    </div>
                                </a></li>
                            <li><a href="/outgoing">
                                    <div class="flex items-center"><svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                            <path class="fill-current text-indigo-400 " d="M1 3h22v20H1z"></path>
                                            <path class="fill-current text-secondary "
                                                d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z">
                                            </path>
                                        </svg><span
                                            class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Outgoing
                                            Product
                                        </span>
                                    </div>
                                </a></li>
                            <li><a href="/product-request">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-accent"
                                                    d="M19 5h1v14h-2V7.414L5.707 19.707 5 19H4V5h2v11.586L18.293 4.293 19 5Z">
                                                </path>
                                                <path class="fill-current text-indigo-400"
                                                    d="M5 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm14 0a4 4 0 1 1 0-8 4 4 0 0 1 0 8ZM5 23a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm14 0a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Product
                                                Request</span>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a href="/purchase-transaction">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-accent"
                                                    d="M8 1v2H3v19h18V3h-5V1h7v23H1V1z">
                                                </path>
                                                <path class="fill-current text-accent" d="M1 1h22v23H1z"></path>
                                                <path class="fill-current text-indigo-400"
                                                    d="M15 10.586L16.414 12 11 17.414 7.586 14 9 12.586l2 2zM5 0h14v4H5z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Purchase
                                                Transaction</span>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a href="/sales-transaction">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-indigo-700"
                                                    d="M4.418 19.612A9.092 9.092 0 0 1 2.59 17.03L.475 19.14c-.848.85-.536 2.395.743 3.673a4.413 4.413 0 0 0 1.677 1.082c.253.086.519.131.787.135.45.011.886-.16 1.208-.474L7 21.44a8.962 8.962 0 0 1-2.582-1.828Z">
                                                </path>
                                                <path class="fill-current text-accent"
                                                    d="M10.034 13.997a11.011 11.011 0 0 1-2.551-3.862L4.595 13.02a2.513 2.513 0 0 0-.4 2.645 6.668 6.668 0 0 0 1.64 2.532 5.525 5.525 0 0 0 3.643 1.824 2.1 2.1 0 0 0 1.534-.587l2.883-2.882a11.156 11.156 0 0 1-3.861-2.556Z">
                                                </path>
                                                <path class="fill-current text-slate-400"
                                                    d="M21.554 2.471A8.958 8.958 0 0 0 18.167.276a3.105 3.105 0 0 0-3.295.467L9.715 5.888c-1.41 1.408-.665 4.275 1.733 6.668a8.958 8.958 0 0 0 3.387 2.196c.459.157.94.24 1.425.246a2.559 2.559 0 0 0 1.87-.715l5.156-5.146c1.415-1.406.666-4.273-1.732-6.666Zm.318 5.257c-.148.147-.594.2-1.256-.018A7.037 7.037 0 0 1 18.016 6c-1.73-1.728-2.104-3.475-1.73-3.845a.671.671 0 0 1 .465-.129c.27.008.536.057.79.146a7.07 7.07 0 0 1 2.6 1.711c1.73 1.73 2.105 3.472 1.73 3.846Z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sales
                                                Transactions</span></div>
                                    </div>
                                </a></li>
                        @endif
                        {{-- <li><a href="">
                                <div class="flex items-center"><svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path class="fill-current text-accent"
                                            d="M20 7a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 0120 7zM4 23a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 014 23z">
                                        </path>
                                        <path class="fill-current text-indigo-400"
                                            d="M17 23a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 010-2 4 4 0 004-4 1 1 0 012 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1zM7 13a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 110-2 4 4 0 004-4 1 1 0 112 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1z">
                                        </path>
                                    </svg><span
                                        class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Campaigns</span>
                                </div>
                            </a></li>
                        <li><a href="#0">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center"><svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                            <path class="fill-current text-accent"
                                                d="M19.714 14.7l-7.007 7.007-1.414-1.414 7.007-7.007c-.195-.4-.298-.84-.3-1.286a3 3 0 113 3 2.969 2.969 0 01-1.286-.3z">
                                            </path>
                                            <path class="fill-current text-indigo-400"
                                                d="M10.714 18.3c.4-.195.84-.298 1.286-.3a3 3 0 11-3 3c.002-.446.105-.885.3-1.286l-6.007-6.007 1.414-1.414 6.007 6.007z">
                                            </path>
                                            <path class="fill-current text-accent"
                                                d="M5.7 10.714c.195.4.298.84.3 1.286a3 3 0 11-3-3c.446.002.885.105 1.286.3l7.007-7.007 1.414 1.414L5.7 10.714z">
                                            </path>
                                            <path class="fill-current text-indigo-400"
                                                d="M19.707 9.292a3.012 3.012 0 00-1.415 1.415L13.286 5.7c-.4.195-.84.298-1.286.3a3 3 0 113-3 2.969 2.969 0 01-.3 1.286l5.007 5.006z">
                                            </path>
                                        </svg><span
                                            class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
                                    </div>
                                </div>
                            </a></li> --}}
                        @if (auth()->user()->role == 'staff')
                            <li><a href="/dashboard">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-indigo-500"
                                                    d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z">
                                                </path>
                                                <path class="fill-current text-accent"
                                                    d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z">
                                                </path>
                                                <path class="fill-current text-indigo-200"
                                                    d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                                        </div>
                                    </div>
                                </a></li>
                            <div class="divider">Master Data</div>
                            <li><a href="/product">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-indigo-400"
                                                    d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z"></path>
                                                <path class="fill-current text-indigo-700"
                                                    d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z"></path>
                                                <path class="fill-current text-accent"
                                                    d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Product</span>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a href="/customer">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-accent"
                                                    d="M18.974 8H22a2 2 0 012 2v6h-2v5a1 1 0 01-1 1h-2a1 1 0 01-1-1v-5h-2v-6a2 2 0 012-2h.974zM20 7a2 2 0 11-.001-3.999A2 2 0 0120 7zM2.974 8H6a2 2 0 012 2v6H6v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5H0v-6a2 2 0 012-2h.974zM4 7a2 2 0 11-.001-3.999A2 2 0 014 7z">
                                                </path>
                                                <path class="fill-current text-indigo-400"
                                                    d="M12 6a3 3 0 110-6 3 3 0 010 6zm2 18h-4a1 1 0 01-1-1v-6H6v-6a3 3 0 013-3h6a3 3 0 013 3v6h-3v6a1 1 0 01-1 1z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer</span>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a href="/supplier">
                                    <div class="flex items-center"><svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                            <path class="fill-current text-accent" d="M16 13v4H8v-4H0l3-9h18l3 9h-8Z">
                                            </path>
                                            <path class="fill-current text-indigo-400"
                                                d="m23.72 12 .229.686A.984.984 0 0 1 24 13v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-8c0-.107.017-.213.051-.314L.28 12H8v4h8v-4H23.72ZM13 0v7h3l-4 5-4-5h3V0h2Z">
                                            </path>
                                        </svg><span
                                            class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Supplier</span>
                                    </div>
                                </a></li>
                        @endif
                        @if (Auth::user()->role == 'user')
                            <li><a href="/dashboard">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-indigo-500"
                                                    d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z">
                                                </path>
                                                <path class="fill-current text-accent"
                                                    d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z">
                                                </path>
                                                <path class="fill-current text-indigo-200"
                                                    d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a href="/product-request">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center"><svg class="shrink-0 h-6 w-6"
                                                viewBox="0 0 24 24">
                                                <path class="fill-current text-accent"
                                                    d="M19 5h1v14h-2V7.414L5.707 19.707 5 19H4V5h2v11.586L18.293 4.293 19 5Z">
                                                </path>
                                                <path class="fill-current text-indigo-400"
                                                    d="M5 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm14 0a4 4 0 1 1 0-8 4 4 0 0 1 0 8ZM5 23a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm14 0a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z">
                                                </path>
                                            </svg><span
                                                class="text-sm  font-medium ml-3 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Product
                                                Request</span>
                                        </div>
                                    </div>
                                </a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost text-xl">Inventory Apps</a>
        </div>
        <div class="navbar-end">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-outline btn-error">
                    Logout
                </button>
            </form>
        </div>
    </div>
    @yield('content')
    <footer class="footer footer-center p-4 bg-base-300 text-base-content">
        <aside>
            <p>Copyright © 2025 - All right reserved by Rio Mulya Syawal</p>
        </aside>
    </footer>
</body>

</html>
