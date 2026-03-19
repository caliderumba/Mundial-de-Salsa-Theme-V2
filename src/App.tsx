import React from 'react';

const App = () => {
  return (
    <div className="min-h-screen bg-slate-950 text-white flex flex-col items-center justify-center p-8 text-center">
      <h1 className="text-6xl font-black uppercase italic tracking-tighter mb-4">
        MundialdeSalsa <span className="text-emerald-500">Pro</span>
      </h1>
      <p className="text-slate-400 max-w-md font-medium leading-relaxed">
        El motor de alto rendimiento para tu revista digital de salsa. 
        Accede al panel de administración de WordPress para configurar tu tema.
      </p>
      <div className="mt-12 flex gap-4">
        <div className="px-6 py-3 bg-emerald-500 rounded-full text-xs font-black uppercase tracking-widest">
          Vite Server Active
        </div>
        <div className="px-6 py-3 bg-white/10 rounded-full text-xs font-black uppercase tracking-widest">
          WordPress Theme Ready
        </div>
      </div>
    </div>
  );
};

export default App;
