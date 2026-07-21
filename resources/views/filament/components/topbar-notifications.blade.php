<div
    class="tu-topbar-notif"
    x-data="{
        open: false,
        loading: true,
        total: 0,
        items: [],
        rawItems: [],
        dismissedMarkers: {},
        poller: null,
        storageKey: 'siatu-notifications-read-v1-' + @js(auth()->id()),
        endpoint: @js(route('api.notifications')),
        loadDismissed() {
            try {
                this.dismissedMarkers = JSON.parse(localStorage.getItem(this.storageKey) || '{}')
            } catch (error) {
                this.dismissedMarkers = {}
            }
        },
        applyNotifications() {
            this.items = this.rawItems.map(item => {
                const marker = Number(this.dismissedMarkers[item.key] || 0)
                const count = (item.ids || []).filter(id => Number(id) > marker).length

                return {
                    ...item,
                    count,
                    active: count > 0,
                    description: this.descriptionFor(item.key, count),
                }
            }).filter(item => item.count > 0)

            this.total = this.items.reduce((sum, item) => sum + item.count, 0)
        },
        async load() {
            this.loading = true

            try {
                const response = await fetch(this.endpoint, {
                    cache: 'no-store',
                    headers: {
                        Accept: 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials: 'same-origin',
                })

                if (! response.ok) {
                    throw new Error('Gagal mengambil notifikasi')
                }

                const data = await response.json()
                this.rawItems = data.items ?? []
                this.applyNotifications()
            } catch (error) {
                this.total = 0
                this.items = []
            } finally {
                this.loading = false
            }
        },
        badgeText() {
            return this.total > 99 ? '99+' : this.total
        },
        clearNotifications() {
            const markers = { ...this.dismissedMarkers }

            this.rawItems.forEach(item => {
                markers[item.key] = Math.max(
                    Number(markers[item.key] || 0),
                    Number(item.latest_id || 0),
                )
            })

            this.dismissedMarkers = markers
            try {
                localStorage.setItem(this.storageKey, JSON.stringify(markers))
            } catch (error) {}

            this.applyNotifications()
            this.loading = false
        },
        descriptionFor(key, count) {
            return {
                surat_masuk: `${count} surat masuk baru telah dicatat.`,
                disposisi: `${count} disposisi baru telah dibuat.`,
                surat_keluar: `${count} surat keluar baru telah dicatat.`,
            }[key] ?? `${count} notifikasi baru.`
        },
        iconText(key) {
            return {
                surat_masuk: 'SM',
                disposisi: 'DP',
                surat_keluar: 'SK',
            }[key] ?? 'NT'
        },
    }"
    x-init="loadDismissed(); load(); poller = setInterval(() => load(), 30000); $cleanup(() => clearInterval(poller))"
    x-on:keydown.escape.window="open = false"
>
    <style>
        .tu-topbar-notif { position:relative; display:flex; align-items:center; margin-inline:2px 8px; }
        .tu-notif-trigger { position:relative; width:36px; height:36px; border:0; border-radius:999px; display:inline-flex; align-items:center; justify-content:center; background:transparent; color:#6b7280; cursor:pointer; transition:background .15s,color .15s; }
        .tu-notif-trigger:hover { background:#f3f4f6; color:#0058be; }
        .tu-notif-badge { position:absolute; top:4px; right:3px; min-width:17px; height:17px; padding:0 5px; border-radius:999px; background:#e11d48; color:#fff; font-size:10px; line-height:17px; font-weight:800; text-align:center; border:2px solid #fff; }
        .tu-notif-panel { position:absolute; top:44px; right:0; width:min(380px, calc(100vw - 24px)); background:#fff; border:1px solid #e5e7eb; border-radius:12px; box-shadow:0 18px 45px rgba(15,23,42,.16); overflow:hidden; z-index:60; }
        .tu-notif-head { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:13px 16px; border-bottom:1px solid #eef0f5; }
        .tu-notif-title { display:flex; align-items:center; gap:8px; font-size:14px; font-weight:800; color:#191b23; }
        .tu-notif-title-badge { min-width:19px; height:19px; padding:0 6px; border-radius:999px; background:#e11d48; color:#fff; font-size:10px; line-height:19px; font-weight:800; text-align:center; }
        .tu-notif-actions { display:flex; align-items:center; gap:10px; }
        .tu-notif-action { border:0; background:transparent; cursor:pointer; padding:0; font-size:11px; font-weight:700; }
        .tu-notif-action.refresh { color:#0058be; }
        .tu-notif-action.delete { color:#e11d48; }
        .tu-notif-list { max-height:350px; overflow:auto; }
        .tu-notif-row { display:flex; gap:11px; padding:13px 16px; border-bottom:1px solid #f0f1f5; background:#fff; }
        .tu-notif-row:last-child { border-bottom:0; }
        .tu-notif-row.active { background:#fff7f7; border-left:3px solid #e11d48; padding-left:13px; }
        .tu-notif-icon { flex:0 0 34px; width:34px; height:34px; border-radius:10px; display:flex; align-items:center; justify-content:center; background:#eff6ff; color:#0058be; font-size:11px; font-weight:900; }
        .tu-notif-row.active .tu-notif-icon { background:#fee2e2; color:#e11d48; }
        .tu-notif-name { font-size:12.5px; font-weight:800; color:#191b23; margin-bottom:3px; }
        .tu-notif-desc { font-size:12px; line-height:1.4; color:#4b5563; }
        .tu-notif-meta { margin-top:7px; font-size:10.5px; color:#8a90a2; }
        .tu-notif-empty { padding:22px 16px; text-align:center; color:#6b7280; font-size:12.5px; }
        html.dark .tu-notif-panel { background:#111827; border-color:#374151; }
        html.dark .tu-notif-head, html.dark .tu-notif-row { border-color:#263244; }
        html.dark .tu-notif-row { background:#111827; }
        html.dark .tu-notif-row.active { background:#2a1720; }
        html.dark .tu-notif-title, html.dark .tu-notif-name { color:#f9fafb; }
        html.dark .tu-notif-desc { color:#d1d5db; }
    </style>

    <button type="button" class="tu-notif-trigger" title="Notifikasi" x-on:click="open = ! open; if (open) load()">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>

        <span class="tu-notif-badge" x-cloak x-show="total > 0" x-text="badgeText()"></span>
    </button>

    <div class="tu-notif-panel" x-cloak x-show="open" x-transition.origin.top.right x-on:click.outside="open = false">
        <div class="tu-notif-head">
            <div class="tu-notif-title">
                Notifikasi
                <span class="tu-notif-title-badge" x-cloak x-show="total > 0" x-text="badgeText()"></span>
            </div>
            <div class="tu-notif-actions">
                <button type="button" class="tu-notif-action refresh" x-on:click="load()">
                    Refresh
                </button>
                <button type="button" class="tu-notif-action delete" x-on:click="clearNotifications()" x-show="total > 0">
                    Tandai dibaca
                </button>
            </div>
        </div>

        <div class="tu-notif-list">
            <template x-if="loading">
                <div class="tu-notif-empty">Memuat notifikasi...</div>
            </template>

            <template x-if="! loading && total === 0">
                <div class="tu-notif-empty">Belum ada notifikasi baru.</div>
            </template>

            <template x-if="! loading && total > 0">
                <div>
                    <template x-for="item in items" :key="item.key">
                        <div class="tu-notif-row" :class="{ active: item.active }">
                            <div class="tu-notif-icon" x-text="iconText(item.key)"></div>
                            <div>
                                <div class="tu-notif-name" x-text="item.label"></div>
                                <div class="tu-notif-desc" x-text="item.description"></div>
                                <div class="tu-notif-meta" x-text="'Modul: ' + item.module"></div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </div>
</div>
