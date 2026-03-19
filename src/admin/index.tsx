import React from 'react';
import ReactDOM from 'react-dom/client';

const Dashboard = () => {
  return (
    <div className="p-8 max-w-6xl mx-auto">
      <header className="mb-12 flex justify-between items-end">
        <div>
          <h1 className="text-4xl font-black uppercase italic tracking-tighter text-slate-900">
            MundialdeSalsa <span className="text-emerald-500">Pro</span>
          </h1>
          <p className="text-xs font-bold uppercase tracking-[0.3em] text-slate-400 mt-2">Panel de Control del Tema</p>
        </div>
        <div className="text-[10px] font-black uppercase tracking-widest text-emerald-500 bg-emerald-50 px-3 py-1 rounded">
          Versión 1.0.0
        </div>
      </header>

      <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
        {/* Stats Card */}
        <div className="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-between h-48">
          <span className="text-[10px] font-black uppercase tracking-widest text-slate-400">Estado del Sistema</span>
          <div className="flex items-baseline gap-2">
            <span className="text-4xl font-black italic tracking-tighter text-slate-900">Óptimo</span>
            <div className="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
          </div>
          <p className="text-xs font-medium text-slate-500">Todos los módulos están activos y funcionando.</p>
        </div>

        {/* Quick Actions */}
        <div className="md:col-span-2 bg-slate-900 p-8 rounded-[2.5rem] shadow-xl text-white relative overflow-hidden">
          <div className="relative z-10 h-full flex flex-col justify-between">
            <span className="text-[10px] font-black uppercase tracking-widest text-emerald-400">Acciones Rápidas</span>
            <div className="flex gap-4">
              <button className="bg-white text-slate-900 px-6 py-3 rounded-full text-xs font-black uppercase tracking-widest hover:bg-emerald-400 hover:text-white transition-all">
                Limpiar Caché
              </button>
              <button className="bg-white/10 text-white px-6 py-3 rounded-full text-xs font-black uppercase tracking-widest hover:bg-white/20 transition-all">
                Ver Documentación
              </button>
            </div>
            <p className="text-xs font-medium text-slate-400">Optimiza el rendimiento de tu sitio con un solo clic.</p>
          </div>
          {/* Decorative element */}
          <div className="absolute -right-12 -top-12 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl"></div>
        </div>
      </div>

      <div className="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-8">
        {/* Modules List */}
        <div className="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
          <h3 className="text-xs font-black uppercase tracking-[0.3em] mb-8 text-slate-400 flex items-center gap-3">
            <span className="w-2 h-2 bg-emerald-500 rounded-full"></span>
            Módulos Activos
          </h3>
          <ul className="space-y-6">
            {[
              { name: 'Traffic Engine', desc: 'Infinite scroll y carga dinámica.', status: true },
              { name: 'Layout Engine', desc: 'Personalización de rejillas y listas.', status: true },
              { name: 'Ads System', desc: 'Gestión inteligente de publicidad.', status: true },
              { name: 'Performance Pro', desc: 'Optimización de scripts y estilos.', status: true },
            ].map((module, i) => (
              <li key={i} className="flex justify-between items-center group">
                <div>
                  <h4 className="text-sm font-black uppercase tracking-widest text-slate-900 group-hover:text-emerald-500 transition-colors">{module.name}</h4>
                  <p className="text-xs text-slate-400 font-medium">{module.desc}</p>
                </div>
                <div className="w-10 h-6 bg-emerald-100 rounded-full relative p-1">
                  <div className="absolute right-1 top-1 w-4 h-4 bg-emerald-500 rounded-full"></div>
                </div>
              </li>
            ))}
          </ul>
        </div>

        {/* Support & Community */}
        <div className="bg-emerald-50 p-8 rounded-[2.5rem] border border-emerald-100">
          <h3 className="text-xs font-black uppercase tracking-[0.3em] mb-8 text-emerald-600 flex items-center gap-3">
            <span className="w-2 h-2 bg-emerald-500 rounded-full"></span>
            Soporte Premium
          </h3>
          <div className="space-y-6">
            <p className="text-sm font-medium text-emerald-800 leading-relaxed">
              ¿Necesitas ayuda con la configuración? Nuestro equipo de expertos está disponible para ayudarte a sacar el máximo provecho de MundialdeSalsa Pro.
            </p>
            <a href="#" className="inline-block bg-emerald-500 text-white px-8 py-4 rounded-full text-xs font-black uppercase tracking-widest shadow-lg shadow-emerald-500/20 hover:bg-emerald-600 transition-all">
              Abrir Ticket de Soporte
            </a>
          </div>
        </div>
      </div>
    </div>
  );
};

const rootElement = document.getElementById('mds-pro-dashboard');
if (rootElement) {
  const root = ReactDOM.createRoot(rootElement);
  root.render(<Dashboard />);
}
